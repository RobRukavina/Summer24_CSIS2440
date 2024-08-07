<?php
// to inherit it is not : like c#, it would be as follows:

// class Dog extends Animal{
// this constructor is how you overload the constructor from parent
//      public function __construct($a, $n, etc., $ws){
//          parent::__construct($a, $n, etc.)
//          $this->setWs($ws);
//      }
//      public function __toString(){
//          $parentString = parent::__toString();
//          // getClass() will get the name of the class that you're in
//          return $parentString + other stuff that is the reason for overload.
//      }
// 
//      throw errors this way:
//      private function validateNum($num){
//          if(!isNumeric($num)){
//                throw new Exception("$num needs to be a number")
//          }
//      }  
//      then handle with try catch
//      try{
//          if($this->validateNums($a)){
//      }
//      catch(Exception $e){
//          echo "error: " . $e->getMessage();
//          the next line will make the whole application stop since there is an error
//          die();
//      }
// 
// 

//}

    class Dog{
        private $furColor;
        private $numLegs;
        private $isAGoodDoggy = true;
        private $weight;
        private $name;
        private $height;
        private $age; 
        private $sex;

        public function __construct($a, $s, $w, $c, $n){
            $this->setAge($a);
            $this->setSex($s);
            $this->setWeight($w);
            $this->setFurColor($c);
            $this->setName($n);
        }

        public function __toString(){
            return "<p>Access all the properties of a dog you want to print ther with dart operator, like this: \$this->getName() etc. This will be used to print a string of dog object.";
        }

        public function setAge($a){
            if(is_numeric($a) && $a > 0){
                $this->age = $a;
            } else {
                echo 'enter a number greater than 0';
                die();
            }
        }

        public function setFurColor($c){
            $this->furColor = $c;
        }
        public function setLegs($l){
            $this->numLegs = $l;
        }
        public function setIsGood($bool){
            $this->isAGoodDoggy= $bool;
        }
        public function setWeight($w){
            $this->weight= $w;
        }
        public function setName($n){
            $this->name = $n;
        }
        public function setHeight($h){
            $this->height = $h;
        }
        public function setSex($s){
            $this->sex = $s;
        }

        public function getFurColor(){
            return $this->furColor;
        }
        public function getLegs(){
            return $this->numLegs;
        }
        public function getIsGood(){
            return $this->isAGoodDoggy;
        }
        public function getWeight(){
            return $this->weight;
        }
        public function getName(){
            return $this->name;
        }
        public function getHeight(){
            return $this->height;
        }
        public function getAge(){
            return $this->age;
        }
        public function getSex(){
            return $this->sex;
        }
    }
?>