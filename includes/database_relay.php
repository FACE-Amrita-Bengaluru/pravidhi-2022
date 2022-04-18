<?php
    class DB_Relay
    {
        function Stack()
        {
            return $this -> _query_stack;
        }

        function __construct($host = null, $user = null, $password = null, $database = null, $port = null, $socket = null)
        {
            $this->Link($host, $user, $password, $database, $port, $socket);
            $this->EmptyStack();
        }

        function __destruct()
        {
            if($this->isLinked())
                @mysqli_close($this->GetLink());
        }

        public function RelayQuery(string $query)
        {
            try {
                $result = mysqli_query($this->GetLink(), $this->CleanQuery($query));
                return $result;
            } catch (Exception $e) {
                throw $e;
            }
        }
        
        public function RelayStack()
        {
            $result = mysqli_query($this->GetLink(), $this->_query_stack);
            
            if ($result -> errno)
                throw "MySQL query failed:" . $result -> error;
            
            return $result;
        }

        public function PrepareQuery(string $query)
        {
            $result = mysqli_prepare($this->GetLink(), $this->CleanQuery($query));
            
            if ($result -> errno)
                throw "MySQL prepare failed:" . $result -> error;
            
            return $result;
        }

        public function PrepareStack()
        {
            $result = mysqli_prepare($this->GetLink(), $this->_query_stack);
            
            if ($result -> errno)
                throw "MySQL prepare failed:" . $result -> error;
            
            return $result;
        }

        public function PushQuery(string $query)
        {
            $this->_query_stack .= $this->CleanQuery($query);
        }

        public function PopQuery()
        {
            $popped = "";

            if($this->isEmptyStack()){
                $start = strrpos($this->_query_stack, ";", -2);

                if($start !== false)
                    ++$start;
            
                $popped = substr($this->_query_stack, $start);
                $this->_query_stack = substr($this->_query_stack, 0, -strlen($popped));
            }

            return $popped;
        }
      
        public function EmptyStack()
        {
            $this->_query_stack = "";
        }
        
        public function FlushStack()
        {
            try {
                $response = $this->RelayStack();
                $this->EmptyStack();
                return $response;
            } catch (Exception $e) {
                $this->EmptyStack();
                throw $e;
            }
        }

        public function isEmptyStack()
        {
            return $this->_query_stack == "";
        }
        
        public function GetLink()
        {
            return $this->_db_link;
        }

        public function isLinked()
        {
            if(isset($this->_db_link))
                return $this->_db_link !== false;
            return false;
        }

        public function Link(
            $host = null,
            $user = null,
            $password = null,
            $database = null,
            $port = null,
            $socket = null
        )
        { 
            $connect = mysqli_connect(
                $host,
                $user,
                $password,
                $database,
                $port,
                $socket
                )
                OR die('MySQL connection failed:' . mysqli_connect_error());

            $this->_db_link = $connect;
        }

        private function CleanQuery($query)
        {
            return preg_replace("/[\s]{2,}/", " ", rtrim(trim($query, " \t\n\r\0\x0B"), "\;") . ";");
        }

        private mysqli $_db_link;
        private string $_query_stack;
    }
