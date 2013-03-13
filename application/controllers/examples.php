<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->checkuser();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    function _example_output($output = null)
    {
        $this->load->view('example.php',$output);
    }

    function offices()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function index()
    {
        $this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
    }

    function dictionaries_management()
    {
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('polyacer_dict_related');
            $crud->set_subject('牌号');
            $crud->unset_print();
            $crud->unset_export();
            //$crud->required_fields('city');
            //$crud->columns('city','country','phone','addressLine1','postalCode');
            $crud->columns('id','typeid','factoryid','nameid','noid');
            $crud->set_relation('typeid','polyacer_dict_type','typename');
            $crud->set_relation('factoryid','polyacer_dict_factory','factoryname');
            $crud->set_relation('nameid','polyacer_dict_name','name');
            $crud->set_relation('noid','polyacer_dict_number','no');
            $crud->display_as('typeid','类型');
            $crud->display_as('factoryid','厂家');
            $crud->display_as('nameid','名称');
            $crud->display_as('noid','牌号');
            $output = $crud->render();

            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function material_name_management()
    {
        $crud = new grocery_CRUD();
        $crud->unset_print();
        $crud->unset_export();
        $crud->set_theme('datatables');
        $crud->columns('name');
        $crud->fields('name');
        $crud->set_table('polyacer_dict_name');
        $crud->display_as('name','名称');
        $crud->set_subject('材料名称');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function factory_management()
    {
        $crud = new grocery_CRUD();
        $crud->unset_print();
        $crud->unset_export();
        $crud->set_theme('datatables');
        $crud->columns('factoryname');
        $crud->fields('factoryname');
        $crud->set_table('polyacer_dict_factory');
        $crud->display_as('factoryname','工厂');
        $crud->set_subject('工厂');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function no_management()
    {
        $crud = new grocery_CRUD();
        $crud->unset_print();
        $crud->unset_export();
        $crud->set_theme('datatables');
        $crud->columns('no');
        $crud->fields('no');
        $crud->set_table('polyacer_dict_number');
        $crud->display_as('no','牌号');
        $crud->set_subject('牌号');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function type_management()
    {
        $crud = new grocery_CRUD();
        $crud->unset_print();
        $crud->unset_export();
        $crud->set_theme('datatables');
        $crud->columns('typename');
        $crud->fields('typename');
        $crud->set_table('polyacer_dict_type');
        $crud->display_as('typename','种类');
        $crud->set_subject('种类');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function checkuser(){
        //if(isset($_SESSION['dede_admin_id']))
        //{
            //$this->userID = $_SESSION['dede_admin_id'];
            //$this->userType = $_SESSION['dede_admin_channel'];
            //$this->userChannel = $_SESSION['dede_admin_type'];
            //$this->userName = $_SESSION['dede_admin_name'];
            //$this->userPurview = $_SESSION['dede_admin_purview'];
            //$this->adminStyle = $_SESSION['dede_admin_style'];
session_start();
if($_SESSION['dede_admin_id']=='')
{
    header("location:http://".$_SERVER['SERVER_NAME']."/dd/dede/login.php?gotopage=".current_url());
    exit();
}

    }
}
