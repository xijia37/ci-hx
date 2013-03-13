<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->checkuser();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    function _example_output($output = null)
    {
        $this->load->view('contact.php',$output);
    }

    function index()
    {
        $this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
    }

    function contact()
    {
        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('pa_contact');
            $crud->set_subject('联系人');
            $crud->unset_fields('RecordDate');
            $crud->unset_print();
            $crud->unset_export();
            //$crud->required_fields('city');
            //$crud->columns('city','country','phone','addressLine1','postalCode');
            $crud->columns('Name','Age','Address','contact_group', 'dict');
            $crud->set_relation_n_n('contact_group', 'pa_contact_contact_group', 'pa_contact_group', 'contact_id', 'group_id', 'name');
            $crud->set_relation_n_n('dict', 'pa_contact_dict', 'pa_dictlist', 'contact_id', 'dict_id', 'name', 'id');
            //$crud->callback_field('dict', array($this,'call_back_option'));
            $crud->display_as('name','名字');
            $crud->display_as('dict','dictionary');
            $crud->display_as('contact_group','联系人组');
            $crud->display_as('Age','年纪');
            $crud->display_as('Address','地址');
            //$crud->display_as('noid','牌号');
            $output = $crud->render();

            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

    function contact_group()
    {
        $crud = new grocery_CRUD();
        $crud->unset_print();
        $crud->unset_export();
        $crud->set_theme('datatables');
        $crud->columns('name');
        $crud->fields('name');
        $crud->set_table('pa_contact_group');
        $crud->display_as('name','名称');
        $crud->set_subject('联系人组');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function dict()
    {
        $crud = new grocery_CRUD();
        $crud->unset_print();
        $crud->unset_export();
        $crud->set_theme('datatables');
        $crud->columns('name');
        $crud->fields('name');
        $crud->set_table('pa_dictlist');
        $crud->display_as('name','名称');
        $crud->set_subject('dictonary');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function call_back_option(){
        $output = "<select id='field-dict' name='dict[]' multiple='multiple' size='10' class='multiselect' data-placeholder='Select dicts' style=''  selected='selected'>";
        $this->load->database();
        $res = $this->db->select('*')->get('pa_dictlist')->result_array();
        foreach ($res as $row)
        {
            $output.= "<option value='{$row['id']}'>{$row['name']}</option></select>";
        }
        return $output;
    }

}
