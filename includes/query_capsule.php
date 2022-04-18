<?php
class Field_Rel implements ArrayAccess
{
    private array $_Fields;

    function __construct(string ...$many_fields)
    {
        $this->_Fields = $many_fields;
    }

    public function Independent()
    {
        $copy = new Field_Rel(...$this->Data());
        foreach ($copy as $key => $value)
            $copy[$key] = substr($value, strpos($value, ".") + 1);

        return $copy;
    }

    public function Under(string $Parent)
    {
        $copy = new Field_Rel(...$this->Data());
        foreach ($copy->Data() as $key => $value)
            $copy[$key] = $Parent . "." . $value;
        return $copy;
    }

    public function __toString()
    {
        return implode(",", $this->Data());
    }

    public function Data()
    {
        return $this->_Fields;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
            $this->_Fields[] = $value;
        else
            $this->_Fields[$offset] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->_Fields[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->_Fields[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->_Fields[$offset]) ? $this->_Fields[$offset] : null;
    }
}

class Table_Field_Rel
{
    private string $_Table;
    private Field_Rel $_Table_Fields;

    function __construct(string $table_name, string ...$table_fields)
    {
        $this->_Table = $table_name;
        $this->_Table_Fields = new Field_Rel(...$table_fields);
    }

    public function Table()
    {
        return $this->_Table;
    }

    public function GobalField(int $index = 0)
    {
        return $this->Table() . '.' . $this->Field($index);
    }

    public function GlobalFields()
    {
        $array = $this->Fields()->Data();
        foreach ($array as $key => $value)
            $array[$key] = $this->Table() . '.' . $value;

        return new Field_Rel(...$array);
    }

    public function Field(int $index = 0)
    {
        return $this->Fields()->Data()[$index];
    }

    public function Fields()
    {
        return $this->_Table_Fields;
    }
}

class Query_Capsule
{
    public static function Begin()
    {
    }
    public static function End()
    {
    }
    public static function Commit()
    {
    }
    public static function Rollback()
    {
    }

    function __construct(Table_Field_Rel ...$TFRs)
    {
        if ($TFRs)
            foreach ($TFRs as $TFR) {
                $this->_Tables[] = $TFR->Table();
                foreach ($TFR->GlobalFields()->Data() as $selection)
                    $this->_Selections[] = $selection;
            }
        else {
            $this->Tables[] = "";
            $this->Selections[] = "";
        }

        $this->_Conditions = "";
        $this->_Groupings = "";
        $this->_Aggregate_Conditions = "";
        $this->_Orderings = "";
        //$this->_Joins = "";
        $this->_Join_Type = "";
        $this->_Join_Table = "";
        $this->_Join_Condition = "";
    }

    final public function isAssigned()
    {
        return isset($this->_Selections);
    }

    final public function Selection(int $index = 0)
    {
        return $this->_Selections[$index];
    }

    final public function Selections()
    {
        return $this->_Selections;
    }

    final public function SelectionsFrom(string $Table_name)
    {
        $Subset = [];

        $selections = $this->Selections();
        $size = count($selections);
        for ($index = 0; $index < $size; ++$index) {
            $fragments = explode(".", $selections[$index]);

            if ($fragments[0] == $Table_name) {
                do {
                    $Subset[] = $fragments[1];
                    $index++;
                    if (!isset($selections[$index])) {
                        break;
                    }
                    $fragments = explode(".", $selections[$index]);
                } while ($fragments[0] == $Table_name);

                break;
            }
        }

        return $Subset;
    }

    final public function Table(int $index = 0)
    {
        return $this->_Tables[$index];
    }

    final public function Tables()
    {
        return $this->_Tables;
    }

    final function __toString()
    {
        return "{$this->SelectFrom()} {$this->Join()} {$this->Where()} {$this->GroupBy()} {$this->Having()} {$this->OrderBy()}";
    }

    final public function Table_Selection_Map()
    {
        $TS_Set = [];

        foreach ($this->Tables() as $table)
            $TS_Set[$table] = new Field_Rel(...$this->SelectionsFrom($table));

        return $TS_Set;
    }

    public function SelectFrom()
    {
    }

    public function Join()
    {
    }

    public function Where()
    {
    }

    public function GroupBy()
    {
    }

    public function Having()
    {
    }

    public function OrderBy()
    {
    }

    final
    public function SetJoin(string $join_type, string $table_name, string $condition = "", string $select_format = "")
    {
        if (!$join_type) {
            $this->_Join_Type = "";
            return;
        }

        $join_type = $this->Translate($join_type, $select_format);
        $table_name = $this->Translate($table_name, $select_format);

        $condition = $this->Translate($condition, $select_format);

        $this->_Join_Type = $join_type;
        $this->_Join_Table = $table_name;
        $this->_Join_Condition = $condition;
    }

    final public function SetWhere(string $encoded, string $select_format = "")
    {
        $this->_Conditions = $this->Translate($encoded, $select_format);
    }

    final public function SetGrouping(string $encoded, string $select_format = "")
    {
        $this->_Groupings = $this->Translate($encoded, $select_format);
    }

    final public function SetHaving(string $encoded, string $select_format = "")
    {
        $this->_Aggregate_Conditions = $this->Translate($encoded, $select_format);
    }

    final public function SetOrdering(string $encoded, string $select_format = "")
    {
        $this->_Orderings = $this->Translate($encoded, $select_format);
    }

    final protected function Translate(string $encoded, string $reference) //Combines Normalize->FormatShortHand->Parse_All
    {
        return $this->Parse_All($this->FormatShortHand($this->Normalize($encoded), $reference));
    }

    final protected function Normalize(string $abnormal) //removes line ends and places spaces instead
    {
        return trim(str_replace("\n", " ", $abnormal));
    }

    final protected function FormatShortHand(string $canvas, string $format) //formats from placeholder tags [${number}_] to encoded form [$(table_no).(field_no)]
    {
        if ($format) {
            $pieces = explode(",", $format);
            foreach ($pieces as $key => $piece)
                $pieces[$key] = trim($piece);

            $limit = count($pieces);
            for ($var = 0; $var < $limit; ++$var) {
                $replacement = $pieces[$var];
                if (is_numeric($replacement))
                    $replacement = '$' . $replacement;
                else if ($replacement[0] == "#")
                    $replacement = substr($replacement, 1);

                $canvas = str_replace('$' . $var . '_', $replacement, $canvas);
            }

            while (1) {
                $replacement = preg_replace("/" . "[\$][0-9]+?[\_]" . "/", "", $canvas);
                if ($canvas == $replacement)
                    break;
                $canvas = $replacement;
            }
        }

        return $canvas;
    }

    final protected function Parse_All(string $encoded) //converts fields and tables from a Global Reference
    {
        $Table_Field_Map = $this->Table_Selection_Map();
        $Table_Names = $this->Tables();

        $substitute_fields = function (array $matches) use ($Table_Field_Map, $Table_Names) {
            $table_name = $Table_Names[$matches[1]];
            if (!($GlobalFields = $Table_Field_Map[$table_name]))
                return "";
            $fields = $GlobalFields->Under($table_name);
            return $fields[$matches[2]];
        };

        $substitute_tables = function (array $matches) use ($Table_Names) {
            if ($table_name = $Table_Names[$matches[1]])
                return $table_name;
            return "";
        };

        while (1) {
            $advancement = preg_replace_callback("/[\$]([0-9]+)[\.]([0-9]+)/", $substitute_fields, $encoded);
            if ($encoded == $advancement)
                break;
            $encoded = $advancement;
        }

        while (1) {
            $advancement = preg_replace_callback("/[\$]([0-9]+)/", $substitute_tables, $encoded);
            if ($encoded == $advancement)
                break;
            $encoded = $advancement;
        }

        return $encoded;
    }

    final protected function Parse_Fields(string $encoded) //converts fields from a Local Reference
    {
        $Table_Field_Map = $this->Table_Selection_Map();
        $Table_Names = $this->Tables();

        $substitute_fields = function (array $matches) use ($Table_Field_Map, $Table_Names) {
            $table_name = $Table_Names[$matches[1]];
            $fields = $Table_Field_Map[$table_name];
            return $fields[$matches[2]];
        };

        while (1) {
            $advancement = preg_replace_callback("/[\$]([0-9]+)[\.]([0-9]+)/", $substitute_fields, $encoded);
            if ($encoded == $advancement)
                break;
            $encoded = $advancement;
        }

        return $encoded;
    }

    final protected function Parse_Tables(string $encoded) //converts tables from a Global Reference
    {
        $Table_Names = $this->Tables();

        $substitute_tables = function (array $matches) use ($Table_Names) {
            return $Table_Names[$matches[1]];
        };

        while (1) {
            $advancement = preg_replace_callback("/[\$]([0-9]+)/", $substitute_tables, $encoded);
            if ($encoded == $advancement)
                break;
            $encoded = $advancement;
        }

        return $encoded;
    }

    protected array $_Selections;
    protected array $_Tables;

    protected string $_Join_Type;
    protected string $_Join_Table;
    protected string $_Join_Condition;

    protected string $_Conditions;
    protected string $_Groupings;
    protected string $_Aggregate_Conditions;
    protected string $_Orderings;
}

class Oracle_Query_Capsule extends Query_Capsule
{
    public static function Begin()
    {
        return "BEGIN";
    }

    public static function End()
    {
        return "END";
    }

    public static function Commit()
    {
        return "COMMIT";
    }

    public static function Rollback()
    {
        return "ROLLBACK";
    }

    public function SelectFrom()
    {
        if ($this->_Selections)
            return "SELECT " . implode(",", $this->Selections()) . " FROM " . implode(",", $this->Tables());
        return "SELECT * FROM " . implode(",", $this->Tables());
    }

    public function Join()
    {
        return $this->_Joins;
        if ($this->_Join_Type)
            if ($this->_Join_Condition)
                return "{$this->_Join_Type} JOIN {$this->_Join_Table} ON ({$this->_Join_Condition})";
            else
                return "{$this->_Join_Type} JOIN {$this->_Join_Table}";
        return "";
    }

    public function Where()
    {
        if ($this->_Conditions)
            return "WHERE ({$this->_Conditions})";
        return "";
    }

    public function GroupBy()
    {
        if ($this->_Groupings)
            return "GROUP BY ({$this->_Groupings})";
        return "";
    }

    public function Having()
    {
        if ($this->_Aggregate_Conditions)
            return "HAVING ({$this->_Aggregate_Conditions})";
        return "";
    }

    public function OrderBy()
    {
        if ($this->_Orderings)
            return "ORDER BY ({$this->_Orderings})";
        return "";
    }

    public function SelectFromQuery(string $selections, string $select_format = "")
    {
        $selections = $this->Translate($selections, $select_format);
        $tables = implode(",", $this->Tables());
        return "SELECT {$selections} FROM {$tables}";
    }

    public function JoinQuery(string $join_type, string $table_name, string $condition = "", string $select_format = "")
    {
        if (!$join_type)
            return "";

        $join_type = $this->Translate($join_type, $select_format);
        $table_name = $this->Translate($table_name, $select_format);

        if (!$condition)
            return  "{$join_type} JOIN {$table_name}";

        $condition = $this->Translate($condition, $select_format);
        return "{$join_type} JOIN {$table_name} ON ({$condition})";
    }

    public function WhereQuery(string $condition, string $select_format = "")
    {
        $condition = $this->Translate($condition, $select_format);
        return "WHERE ({$condition})";
    }

    public function InsertValuesQuery(string $values, string $fields = "", int $table_index = 0, $select_format = "")
    {
        $table_name = $this->Table($table_index);
        $selections = [];

        if ($fields) {
            $fields = $this->Translate($fields, $select_format);
            $selections = explode(",", $fields);

            foreach ($selections as $key => $selection)
                $selections[$key] = trim($selection);
        } else
            $selections = $this->SelectionsFrom($table_name);

        $selections = new Field_Rel(...$selections);
        $values = $this->Translate($values, $select_format);

        return "INSERT INTO {$table_name} ({$selections}) VALUES ({$values})";
    }

    public function UpdateQuery(string $settings, string $condition = "", int $table_index = 0, $select_format = "")
    {
        $settings = $this->Translate($settings, $select_format);
        $condition = $condition ? $this->Translate($condition, $select_format) : "true";
        $table_name = $this->Table($table_index);
        $reference_table = $table_name . ' ' . $this->Join();

        return "UPDATE {$table_name} SET {$settings} FROM {$reference_table} WHERE {$condition}";
    }

    public function DeleteQuery(string $tables, string $condition = "", string $select_format = "")
    {
        $condition = $this->Translate($condition, $select_format);
        $reference_table = $this->Join();
        return "DELETE {$tables} FROM {$tables} {$reference_table} WHERE {$condition}";
    }

    public function RenameTableQuery(string $new_name, int $table_index = 0, $select_format = "")
    {
        $new_name = $this->Translate($new_name, $select_format);
        return "ALTER TABLE {$this->Table($table_index)} RENAME TO {$new_name}";
    }

    public function RenameColumnsQuery(string $old_name, string $new_name, int $table_index = 0, $select_format = "")
    {
        $old_name = $this->Translate($old_name, $select_format);
        $new_name = $this->Translate($new_name, $select_format);
        return "ALTER TABLE {$this->Table($table_index)} RENAME COLUMN {$old_name} TO {$new_name}";
    }

    public function AddColumnsQuery(string $field_names, string $field_definitions, int $table_index = 0, string $select_format = "")
    {
        $field_initialisations = new Field_Rel();

        $field_names = explode(",", $field_names);
        foreach ($field_names as $key => $field_name)
            $field_names[$key] = trim($field_name);

        $field_definitions = explode(",", $field_definitions);
        foreach ($field_definitions as $key => $field_definition)
            $field_definitions[$key] = trim($field_definition);

        $size = count($field_names);
        for ($index = 0; $index < $size; ++$index)
            $field_initialisations[] = "{$field_names[$index]} {$field_definitions[$index]}";

        $field_initialisations = $this->Translate($field_initialisations, $select_format);

        return "ALTER TABLE {$this->Table($table_index)} ADD ({$field_initialisations})";
    }

    public function ModifyColumnsQuery(string $field_names, string $field_definitions, int $table_index = 0, string $select_format = "")
    {
        $field_initialisations = new Field_Rel();

        $field_names = explode(",", $field_names);
        foreach ($field_names as $key => $field_name)
            $field_names[$key] = trim($field_name);

        $field_definitions = explode(",", $field_definitions);
        foreach ($field_definitions as $key => $field_definition)
            $field_definitions[$key] = trim($field_definition);

        $size = count($field_names);
        for ($index = 0; $index < $size; ++$index)
            $field_initialisations[] = "{$field_names[$index]} {$field_definitions[$index]}";

        $field_initialisations = $this->Translate($field_initialisations, $select_format);

        return "ALTER TABLE {$this->Table($table_index)} MODIFY ({$field_initialisations})";
    }

    public function DropColumnsQuery(string $fields, int $table_index = 0, string $select_format = "")
    {
        $fields = $this->Translate($fields, $select_format);
        return "ALTER TABLE {$this->Table($table_index)} DROP ({$fields})";
    }

    public function SetUnusedColumnsQuery(string $fields, int $table_index = 0, string $select_format = "")
    {
        $fields = $this->Translate($fields, $select_format);
        return "ALTER TABLE {$this->Table($table_index)} SET UNUSED ({$fields})";
    }

    public function DropUnusedColumnsQuery(int $table_index = 0)
    {
        return "ALTER TABLE {$this->Table($table_index)} DROP UNUSED COLUMNS CHECKPOINT 250";
    }

    public function DropTableQuery(int $table_index = 0)
    {
        return "DROP TABLE {$this->Table($table_index)}";
    }
}

class MySQL_Query_Capsule extends Query_Capsule
{
    public function SelectFrom()
    {
        if ($this->_Selections)
            return "SELECT " . implode(",", $this->Selections()) . " FROM " . implode(",", $this->Tables());
        return "SELECT * FROM " . implode(",", $this->Tables());
    }

    public function Join()
    {
        if ($this->_Join_Type) {
            if ($this->_Join_Condition)
                return "{$this->_Join_Type} JOIN {$this->_Join_Table} ON ({$this->_Join_Condition})";
            return "{$this->_Join_Type} JOIN {$this->_Join_Table}";
        }
        return "";
    }

    public function Where()
    {
        if ($this->_Conditions)
            return "WHERE ({$this->_Conditions})";
        return "";
    }

    public function GroupBy()
    {
        if ($this->_Groupings)
            return "GROUP BY ({$this->_Groupings})";
        return "";
    }

    public function Having()
    {
        if ($this->_Aggregate_Conditions)
            return "HAVING ({$this->_Aggregate_Conditions})";
        return "";
    }

    public function OrderBy()
    {
        if ($this->_Orderings)
            return "ORDER BY ({$this->_Orderings})";
        return "";
    }

    public function SelectFromQuery(string $selections, string $select_format = "")
    {
        $selections = $this->Translate($selections, $select_format);
        $tables = implode(",", $this->Tables());
        return "SELECT {$selections} FROM {$tables}";
    }

    public function JoinQuery(string $join_type, string $table_name, string $condition = "", string $select_format = "")
    {
        if (!$join_type)
            return "";

        $join_type = $this->Translate($join_type, $select_format);
        $table_name = $this->Translate($table_name, $select_format);

        if (!$condition)
            return  "{$join_type} JOIN {$table_name}";

        $condition = $this->Translate($condition, $select_format);
        return "{$join_type} JOIN {$table_name} ON ({$condition})";
    }

    public function WhereQuery(string $condition, string $select_format = "")
    {
        $condition = $this->Translate($condition, $select_format);
        return "WHERE ({$condition})";
    }

    public function InsertValuesQuery(string $values, string $fields = "", int $table_index = 0, $select_format = "")
    {
        $table_name = $this->Table($table_index);
        $selections = [];

        if ($fields) {
            $fields = $this->Translate($fields, $select_format);
            $selections = explode(",", $fields);

            foreach ($selections as $key => $selection)
                $selections[$key] = trim($selection);
        } else
            $selections = $this->SelectionsFrom($table_name);

        $selections = new Field_Rel(...$selections);
        $values = $this->Translate($values, $select_format);

        return "INSERT INTO {$table_name} ({$selections}) VALUES ({$values})";
    }

    public function UpdateQuery(string $settings, string $condition = "", int $table_index = 0, $select_format = "")
    {
        $settings = $this->Translate($settings, $select_format);
        $condition = $condition ? $this->Translate($condition, $select_format) : "true";
        $table_name = $this->Table($table_index);
        $reference_table = $table_name . ' ' . $this->Join();

        return "UPDATE {$table_name} SET {$settings} FROM {$reference_table} WHERE ({$condition})";
    }

    public function DeleteQuery(string $tables, string $condition = "", string $select_format = "")
    {
        $condition = $this->Translate($condition, $select_format);
        $reference_table = $tables . ' ' . $this->Join();
        return "DELETE {$tables} FROM {$tables} {$reference_table} WHERE ({$condition})";
    }

    public function RenameTableQuery(string $new_name, int $table_index = 0, $select_format = "")
    {
        $new_name = $this->Translate($new_name, $select_format);
        return "ALTER TABLE {$this->Table($table_index)} RENAME TO {$new_name}";
    }

    public function ChangeColumnsQuery(string $old_names, string $new_names, string $defenitions, int $table_index = 0, $select_format = "")
    {
        $old_names = explode(",", $old_names);
        $new_names = explode(",", $new_names);
        $defenitions = explode(",", $defenitions);

        $changes = new Field_Rel();
        foreach ($old_names as $key => $old_name) {
            $changes[] = "CHANGE COLUMN {$old_names[$key]} {$new_names[$key]} {$defenitions[$key]}";
        }
        $changes = $this->Translate($changes, $select_format);

        return "ALTER TABLE {$this->Table($table_index)} {$changes}";
    }

    public function AddColumnsQuery(string $field_names, string $field_definitions, int $table_index = 0, string $select_format = "")
    {
        $field_initialisations = new Field_Rel();

        $field_names = explode(",", $field_names);
        foreach ($field_names as $key => $field_name)
            $field_names[$key] = trim($field_name);

        $field_definitions = explode(",", $field_definitions);
        foreach ($field_definitions as $key => $field_definition)
            $field_definitions[$key] = trim($field_definition);

        $size = count($field_names);
        for ($index = 0; $index < $size; ++$index)
            $field_initialisations[] = "ADD {$field_names[$index]} {$field_definitions[$index]}";

        $field_initialisations = $this->Translate($field_initialisations, $select_format);

        return "ALTER TABLE {$this->Table($table_index)} {$field_initialisations}";
    }

    public function ModifyColumnsQuery(string $field_names, string $field_definitions, int $table_index = 0, string $select_format = "")
    {
        $field_initialisations = new Field_Rel();

        $field_names = explode(",", $field_names);
        foreach ($field_names as $key => $field_name)
            $field_names[$key] = trim($field_name);

        $field_definitions = explode(",", $field_definitions);
        foreach ($field_definitions as $key => $field_definition)
            $field_definitions[$key] = trim($field_definition);

        $size = count($field_names);
        for ($index = 0; $index < $size; ++$index)
            $field_initialisations[] = "MODIFY {$field_names[$index]} {$field_definitions[$index]}";

        $field_initialisations = $this->Translate($field_initialisations, $select_format);

        return "ALTER TABLE {$this->Table($table_index)} {$field_initialisations}";
    }

    public function DropColumnsQuery(string $fields, int $table_index = 0, string $select_format = "")
    {
        $fields = $this->Translate($fields, $select_format);
        $fields = 'DROP ' . $fields;
        $fields = str_replace(",", ",DROP", $fields);

        return "ALTER TABLE {$this->Table($table_index)} {$fields}";
    }

    public function DropTableQuery(int $table_index = 0)
    {
        return "DROP TABLE {$this->Table($table_index)}";
    }
}
