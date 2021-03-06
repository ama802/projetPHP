<?php
class employeeController{
    public function construct(){}

    public function index(){

    }
    public function add(){
        // $EmployeeID, $NationalIDNumber, $ContactID,$Title, $BirthDate, $Gender, $HireDate
        require_once CLASSES.DS.'renderView.php';
        $v=new renderView();      
        if (isset($_POST["EmployeeID"]))
        {
            require_once MODELS.DS."employeeModel.php";
            $employeeModel =new employeeModel();
            if ($employeeModel->add($_POST["ContactID"],$_POST["ContactTitle"],$_POST["FirstName"],$_POST["LastName"],$_POST["EmailAddress"]
            ,$_POST["EmployeeID"], $_POST["NationalIDNumber"], $_POST["EmployeeTitle"], $_POST["BirthDate"],$_POST["Gender"],$_POST["HireDate"]))
            {
                //return $this->list();
                //header("Location: " . ROOT .DS. "router.php");
                $v->render('home','index');
            }
        }
        else       
        $v->render('employee','add');
    }
    public function list(){
        require_once MODELS.DS."employeeModel.php";
        $employeeModel =new employeeModel();
        $list=$employeeModel->list();
        require_once CLASSES.DS.'renderView.php';
        $v=new renderView();
        $v->setVar('employeelist',$list);
        $v->render('employee','list');
    }
    public function listone($id){
        require_once MODELS.DS.'employeeModel.php';
        $employeeModel =new employeeModel();
        require_once CLASSES.DS.'renderView.php';
        $v=new renderView();
        if ($employee=$employeeModel->listone($id)) $v->setVar('e',$employee);
        // Affichage au sein de la vue des données récupérées via le model
        $v->render('employee','listone');
        
    }
    public function edit($id){

        print_r($id);
        require_once MODELS.DS.'employeeModel.php';
        $employeeModel =new employeeModel();
        $employee=$employeeModel->listEmpCont($id);
        print_r($employee);
        require_once CLASSES.DS.'renderView.php';
        $v=new renderView();
        if (isset($_POST["EmployeeID"]))
        {
                if($employeeModel->edit($_POST["ContactID"],$_POST["ContactTitle"],$_POST["FirstName"],$_POST["LastName"],$_POST["EmailAddress"]
                ,$_POST["EmployeeID"], $_POST["NationalIDNumber"], $_POST["EmployeeTitle"], $_POST["BirthDate"],$_POST["Gender"],$_POST["HireDate"]))
                {
                    $v->render('home','index');
                }
        }
        else {
        $v->setVar('employee',$employee);
        $v->render('employee','edit');
        }
    }
    public function delete($id){
        require_once MODELS.DS.'employeeModel.php';
        $employeeModel =new employeeModel();
        if($employeeModel->delete($id))
        {
            $v->render('home','index');
        }
    }
}
?>