<?php 
    $robot = "";
    $sM = "";
    $sC = "";
    $sOs = "";
    $size = "";
    $msg = "";
    $ec = array();
    $laws = array();
    
class Robot {
    private $model;
    private $color;
    private $os;
    private $image;
    private $size;
    private $laws;
    
    public function __construct(String $m, String $c, String $o, String $i, String $s, Array $sLaws) {
        $this->setModel($m);
        $this->setColor($c);
        $this->setOs($o);
        $this->setImage($i);
        $this->setSize($s);
        $this->setLaws($sLaws);
    }
    
    public function setModel($mo){
        $this->model = $mo;
    }
    
    public function setColor($co){
        $this->color = $co;
    }
    
    public function setOs($oS){
        $this->os = $oS;
    }

    public function setImage($i){
        $this->image = $i;
    }

    public function setSize($s){
        $this->size = $s;
    }

    public function setLaws($sLaws){
        $this->laws = array(); 
        if(sizeof($sLaws)>0){
            foreach($sLaws as $law){
                array_push($this->laws, $law);
            }
        }
    }

    public function getModel(){
        return $this->model;
    }
    
    public function getColor(){
        return $this->color;
    }

    public function getOs(){
        return $this->os;
    }

    public function getImage(){
        return $this->image;
    }

    public function getSize(){
        return $this->size;
    }

    public function getLaws(){
        $res = "";
        $ls = $this->laws;
        if(sizeof($ls) > 0){
            foreach($ls as $l){
                if($l == 1){
                    $res.="<li>1. A robot may not injure a human being or, through inaction, allow a human being to come to harm.</li>"; 
                }
                if($l == 2){
                    $res.="<li>2. A robot must obey the orders given it by human beings except where such orders would conflict with the First Law.</li>";
                }
                if($l == 3){
                    $res.="<li>3. A robot must protect its own existence as long as such protection does not conflict with the First or Second Law.<li>";
                }
            }
        } else {
            $res.= "<span class='warning'>WARNING!!!, your robot has no laws built in!</span>";
        }

        return $res;
    }

    public function toString(){
        return '<div class="text-center">
        <img class="d-flex m-auto img-responsive size-restrict" src="'.$this->getImage().'" alt="robot image" />
        <h2 class="pt-3">Your '.$this->getSize().' sized '.$this->getColor().' '.$this->getModel().' robot running '.$this->getOs().' will be built shortly.</h2> <h4>Your robot will have the following laws built in: </h4><ul class="list-unstyled">'.$this->getLaws().'</ul> <h4>Thank you.</h4></div>';
    }
}
    if(!isset($_SESSION)){
        session_start();
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10)) {
        session_unset(); 
        session_destroy();
    }

    function getImage($m){
        $res = "";
        $imgs = array(
            ["name"=>"Sonny", "url"=>"./img/Sonny.png"],
            ["name"=>"Rosey", "url"=>"./img/rosey.jpeg"],
            ["name"=>"SICO","url"=>"./img/sico.jpg"],
            ["name"=>"Data", "url"=>"./img/Datalooking.png"], 
            ["name"=>"Gort", "url"=>"./img/Gort.jpg"], 
            ["name"=>"Wall-E", "url"=>"./img/stolenWallE.jpg"], 
            ["name"=>"Optimus Prime", "url"=>"./img/Optimus_Prime.png"], 
            ["name"=>"Hal 9000", "url"=>"./img/HAL.png"], 
            ["name"=>"Twiki", "url"=>"./img/Twiki.png"], 
            ["name"=>"Bender", "url"=>"./img/bender.png"], 
            ["name"=>"Johnny 5", "url"=>"./img/johnny5.png"]
        );

        for($i = 0; $i < sizeof($imgs); $i++){
            if($imgs[$i]['name'] == $m){
                $res = $imgs[$i]['url'];
                return $res;
            }
        }
        return $res;
    }

    if(isset($_POST['sbt'])){
        $_SESSION['LAST_ACTIVITY'] = time();
        if(isset($_POST['model']) && $_POST['model'] != "") {
            $sM = $_POST['model'];
        } else {
            array_push($ec, 1);
        }

        if(isset($_POST['color']) && $_POST['color'] != "") {
            $sC = $_POST['color'];
        } else {
            array_push($ec, 2);
        }
        
        if(isset($_POST['os']) && $_POST['os'] != ""){
            $sOs = $_POST['os'];
        } else {
            array_push($ec, 3);
        }

        if(isset($_POST['size']) && $_POST['size'] != ""){
            $size = $_POST['size'];
        } else {
            array_push($ec, 4);
        }

        if(isset($_POST['law1'])){
            $laws[] = 1;
        }

        if(isset($_POST['law2'])){
            $laws[] = 2;
        }
        
        if(isset($_POST['law3'])){
            $laws[] = 3;
        }

        if(sizeof($ec) > 0){
            $_SESSION['ec'] = $ec;
        } else {
            $msg = "";
            $img = getImage($sM);
            $robot = new Robot($sM, $sC, $sOs, $img, $size, $laws);
        }
    }

    if(isset($_SESSION['ec'])){
        $ec = $_SESSION['ec'];

        for($i = 0; $i < sizeof($ec); $i++){
            switch($ec[$i]){
                case 1:
                    $msg.="<p class='warning'>Please select a robot model</p>";
                break;
                case 2:
                    $msg.="<p class='warning'>Please select a robot color</p>";
                break;
                case 3:
                    $msg.="<p class='warning'>Please select a robot OS</p>";
                break;
                case 4:
                    $msg.="<p class='warning'>Please select a robot size</p>";
                break;
            }
        }

        unset($ec);
        $ec = array();
        unset($_SESSION['ec']);
    }
    


    function getModelOpts($sM){
        $res = "";
        $models = array("Sonny", "Rosey", "SICO", "Data", "Gort", "Wall-E", "Optimus Prime", "Hal 9000", "Twiki", "Bender", "Johnny 5");

        for($i = 0; $i < sizeof($models); $i++){
            $res.= '<option '.($models[$i] == $sM ? " selected ": "").' value="'.$models[$i].'">'.$models[$i].'</option>';
        }

        return $res;
    }

    function getColorOpts($sC){
        $res = "";
        $colors = array("Shiny", "Chrome", "Silver", "Brass", "Gold");
        
        for($i = 0; $i < sizeof($colors); $i++){
            $res.= '<option'.($colors[$i] == $sC ? " selected ": "").' value="'.$colors[$i].'">'.$colors[$i].'</option>';
        }

        return $res;
    }

    function getOsOpts($sOs){
        $res = "";
        $os = array("Linux", "Unix", "SPARC", "Binary", "DOS", "Tiny Hamsters");

        for($i = 0; $i < sizeof($os); $i++){
            $res.= '<option'.($os[$i] == $sOs ? " selected ": "").' value="'.$os[$i].'">'.$os[$i].'</option>';
        }

        return $res; 
    }

    function getDisplay($robot, $msg, $sM, $sC, $sOs){
        $res = '';
        if(!isset($_POST['sbt']) || $msg != ""){
            $res .='
                <div class="card pt-3 mt-10">
                    <div class="card-title">
                        <h1 class="text-center">Create a Robot</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="text-center d-block">
                                    '.($msg != "" ? $msg : "").'
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <form method="post">
                                    <div class="form-group text-center">
                                        <label class="mr-2 h5" for="model">Robot Model</label>
                                        <select id="model" name="model">
                                            <option hidden value="">Select model</option>
                                            '.getModelOpts($sM).'
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        <label class="mr-2 h5" for="color">Robot Color</label>
                                        <select id="color" name="color">
                                            <option hidden value="" >Select color</option>'.getColorOpts($sC).'
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        <label class="mr-2 h5" for="os">Robot Operating System</label>
                                        <select id="os" name="os">
                                            <option hidden value="">Select OS</option>
                                            '.getOsOpts($sOs).'
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        <h5 class="pr-3">Robot size:</h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="size" id="inlineRadio1" value="giant">
                                            <label class="form-check-label" for="inlineRadio1">Giant</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="size" id="inlineRadio2" value="normal">
                                            <label class="form-check-label" for="inlineRadio2">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="size" id="inlineRadio3" value="nano">
                                            <label class="form-check-label" for="inlineRadio3">Nano</label>
                                        </div>
                                    </div>
                                    <h5 class="m-auto text-center pb-3">Robot Laws Built In:</h5>
                                    <div class="form-group d-flex">
                                        <div class="form-check text-align-left mr-2">
                                            <input class="form-check-input" type="checkbox" name="law1" id="inlineCheck1">
                                            <label class="form-check-label text-secondary" for="inlineCheck1"><span class="med black">First Law: </span>A robot may not injure a human being or, through inaction, allow a human being to come to harm.</label>
                                        </div>
                                        <div class="form-check text-align-left">
                                            <input class="form-check-input" type="checkbox" name="law2" id="inlineCheck2">
                                            <label class="form-check-label text-secondary" for="inlineCheck2"><span class="med black">Second Law: </span>A robot must obey the orders given it by human beings except where such orders would conflict with the First Law.</label>
                                        </div>
                                        <div class="form-check text-align-left">
                                            <input class="form-check-input" type="checkbox" name="law3" id="inlineCheck3">
                                            <label class="form-check-label text-secondary" for="inlineCheck3"><span class="med black">Third Law: </span>A robot must protect its own existence as long as such protection does not conflict with the First or Second Law.</label>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar justify-content-center">
                                        <button type="submit" name="sbt" class="text-center btn btn-danger btn-md ml-1 mt-4">Build Robot</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            $res .='
                <div class="card pt-3 mt-10">
                    <div class="card-title">
                        <h1 class="text-center">Hang tight,</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <div class="text-center">
                                    '.$robot->toString().'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }

        return $res;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Robot</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <?php include_once("./includes/nav.php") ?>
    <body>
        <main class="blue-grad">
            <div class="container">
                <div class="row">
                    <div class="col-8 m-auto">
                        <?php
                            echo getDisplay($robot, $msg, $sM, $sC, $sOs); 
                        ?>
                    </div>
                    <div <?php echo ($robot ? 'class="white-bkg"': "") ?>>
                        <?php echo ($robot != "" ? var_dump($robot) : "")?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>