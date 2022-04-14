<?php
    class Validate {
        public static function RegNo(string $regno): bool
        {
            $valid = preg_match("/^BL\.EN\.U4(CSE|AIE|EAC|ECE|EEE|MEE)(19|20)[0-9]{3}$/", $regno);
    
            if (!$valid)
                consoleBug("invalid registeration number");
    
            return $valid;
        }

        public static function Name(string $name): bool
        {
            $valid = preg_match("/^[a-zA-Z]+( [a-zA-Z]+){0,2}$/", $name);
    
            if (!$valid)
                consoleBug("invalid name");
    
            return $valid;
        }
    
        public static function Sem(string $sem): bool
        {
            $valid = preg_match("/^4|6$/", $sem);
    
            if (!$valid)
                consoleBug("invalid semester");
    
            return $valid;
        }
    
        public static function Branch(string $branch): bool
        {
            $valid = preg_match("/^CSE|AIE|EAC|ECE|EEE|MEE$/", $branch);
    
            if (!$valid)
                consoleBug("invalid branch");
    
            return $valid;
        }
    
        public static function Email(string $email): bool
        {
            $valid = preg_match("/^([a-zA-Z_][a-zA-Z0-9_]*\.)*([a-zA-Z_][a-zA-Z0-9_]*)\@([a-zA-Z_][a-zA-Z0-9_]*\.)*[a-z]{2,3}$/", $email);
            if (!$valid)
                consoleBug("invalid email");
    
            return $valid;
        }
    
        public static function PhNo(string $phno): bool
        {
            $valid = preg_match("/^[0-9]{10}$/", $phno);
    
            if (!$valid)
                consoleBug("invalid phone number");
    
            return $valid;
        }
    }

    function validateRegNo(string $regno): bool
    {
        return true;
        $valid = preg_match("/^BL\.EN\.U4(CSE|AIE|EAC|ECE|EEE|MEE)(19|20)[0-9]{3}$/", $regno);

        if (!$valid)
            consoleBug("invalid registeration number");

        return $valid;
    }

    function validateName(string $name): bool
    {
        $valid = preg_match("/^[a-zA-Z]+( [a-zA-Z]+){0,2}$/", $name);

        if (!$valid)
            consoleBug("invalid name");

        return $valid;
    }

    function validateSem(string $sem): bool
    {
        $valid = preg_match("/^4|6$/", $sem);

        if (!$valid)
            consoleBug("invalid semester");

        return $valid;
    }

    function validateBranch(string $branch): bool
    {
        $valid = preg_match("/^CSE|AIE|EAC|ECE|EEE|MEE$/", $branch);

        if (!$valid)
            consoleBug("invalid branch");

        return $valid;
    }

    function validateEmail(string $email): bool
    {
        $valid = preg_match("/^([a-zA-Z_][a-zA-Z0-9_]*\.)*([a-zA-Z_][a-zA-Z0-9_]*)\@([a-zA-Z_][a-zA-Z0-9_]*\.)*[a-z]{2,3}$/", $email);
        if (!$valid)
            consoleBug("invalid email");

        return $valid;
    }

    function validatePhNo(string $phno): bool
    {
        $valid = preg_match("/^[0-9]{10}$/", $phno);

        if (!$valid)
            consoleBug("invalid phone number");

        return $valid;
    }
?>