<?php
class Entry extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->load->model('Tournament_model', 'tm');
        $this->load->model('User_model', 'um');
        $this->load->model('Entry_model', 'em');
    }

    function make(){
        // $this->form_vbalidation->set_rules('tournament_id', 'Tourna');
        if($this->input->post('tournament_id')){
            $tournament_data = $this->tm->get($this->input->post('tournament_id'));
            $user_data = $this->um->get($this->session->userdata('id'));
            
            //Check if User Already Applied
            $check_user_applied =  $this->em->get_by_user_torunament($user_data['id'], $tournament_data['id']);
            if($check_user_applied){
                $this->session->set_flashdata('error', 'Sorry You have already Applied for The Tournament');
                redirect('tournament/'.$tournament_data['slug'].'#apply');
            }
            //Check the Tournament Type
            if($tournament_data['type'] == 'individual'){
                //Individual or Solo Type
                $username = array($user_data['username']);
                $data = array(
                    'user_id' => $this->session->userdata('id'),
                    'tournament_id' =>  $tournament_data['id'],
                    'usernames' =>  json_encode($username)
                );
                //Insert Entry
                $result = $this->em->insert($data);

                if($result){
                    //Procced To Payment

                    //Making Entry ID as Order ID
                    $order_id = 'PMNT'.$result;
                    //Payment Gateway Data
                    $payment_data = $this->pay($order_id,$user_data['id'],$tournament_data['entry_fee']);
                    $data = array(
                        'page'  =>  'payment',
                        'title' =>  'Make Payment',
                        'not_loggedin'	=>	$this->session->userdata('id'),
                        'payment_data'  =>  $payment_data,
                    );
                    $this->render_page($data);
                }
                else{
                    $this->session->set_flashdata('error', 'Something went wrong. Please try again');
                    redirect('tournament/'.$tournament_data['slug'].'#apply');
                }
            }
            else{
                //Squad Type
                //Chcheking Usernames
                $this->form_validation->set_rules('squad_member_2', 'Squad Member #2', 'trim|required');
                $this->form_validation->set_rules('squad_member_3', 'Squad Member #3', 'trim|required');
                $this->form_validation->set_rules('squad_member_4', 'Squad Member #4', 'trim|required');

                if($this->form_validation->run()){
                    //Making Usernames in json formatt
                    $squad = array($this->input->post('squad_leader'),$this->input->post('squad_member_2'),$this->input->post('squad_member_3'),$this->input->post('squad_member_4'));
                    $usernames = json_encode($squad);

                    $data = array(
                        'user_id' => $this->session->userdata('id'),
                        'tournament_id' =>  $tournament_data['id'],
                        'usernames' =>  $usernames
                    );
                    //Inserting Result
                    $result = $this->em->insert($data);

                    if($result){
                        //Proceed to Payment

                        //Making Entry ID as Order ID
                        $order_id = 'PMNT'.$result;
                        //Payment Gateway Data
                        $payment_data = $this->pay($order_id,$user_data['id'],$tournament_data['entry_fee']);
                        $data = array(
                            'page'  =>  'payment',
                            'title' =>  'Make Payment',
                            'not_loggedin'	=>	$this->session->userdata('id'),
                            'payment_data'  =>  $payment_data,
                        );
                        $this->render_page($data);

                    }
                    else{
                        //Insert Fail
                        $this->session->set_flashdata('error', 'Something went wrong. Please try again');
                        redirect('tournament/'.$tournament_data['slug'].'#apply');
                    }
                }
                else{
                    //Validation Fail
                    $this->session->set_flashdata('error', validation_errors());
                    redirect('tournament/'.$tournament_data['slug'].'#apply');
                }

                
            }
        }
    }

    private function pay($order_id, $user_id, $amount){
        
        include APPPATH . 'third_party/PaytmKit/lib/config_paytm.php';
        include APPPATH . 'third_party/PaytmKit/lib/encdec_paytm.php';

        $checkSum = "";
        $paramList = array();

        $ORDER_ID = $order_id;
        $CUST_ID = $user_id;
        $INDUSTRY_TYPE_ID = "Retail";
        $CHANNEL_ID = "WEB";
        $TXN_AMOUNT = $amount;

        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $ORDER_ID;
        $paramList["CUST_ID"] = $CUST_ID;
        $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
        $paramList["CHANNEL_ID"] = $CHANNEL_ID;
        $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
        $paramList["CALLBACK_URL"] = base_url()."entry/response";

        /*
        $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
        $paramList["EMAIL"] = $EMAIL; //Email ID of customer
        $paramList["VERIFIED_BY"] = "EMAIL"; //
        $paramList["IS_USER_VERIFIED"] = "YES"; //
        */
        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

        $data = array(
            'param_list'    =>  $paramList,
            'checksum'      =>  $checkSum
        );
        return $data;
    }

    public function response(){
        include APPPATH . 'third_party/PaytmKit/lib/config_paytm.php';
        include APPPATH . 'third_party/PaytmKit/lib/encdec_paytm.php';

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


        if($isValidChecksum == "TRUE") {
            // echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
            preg_match_all('!\d+!', $_POST['ORDERID'], $entry_id);
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                echo "<b>Transaction status is success</b>" . "<br/>";
                //Process your transaction here as success transaction.
                //Verify amount & order id received from Payment gateway with your application's order id and amount.
                $data = array(
                    'transaction_status'=>1,
                    'transaction_id'    => $this->input->post('TXNID')
                );
                $result = $this->em->update($entry_id[0][0],$data);
                if($result){
                    $this->session->set_flashdata('success', 'Payment Successful');
                    redirect('user/profile');
                }
                else{
                    
                }
            }
            else {
                // echo "<b>Transaction status is failure</b>" . "<br/>";
                $result = $this->em->delete($entry_id[0][0]);
                if($result){
                    $this->session->set_flashdata('error', 'Payment has Failed');
                    redirect('user/profile');
                }
            }
            // if (isset($_POST) && count($_POST)>0 )
            // { 
            //     foreach($_POST as $paramName => $paramValue) {
            //             echo "<br/>" . $paramName . " = " . $paramValue;
            //     }
            // }
        
        }
        else {
            $this->session->set_flashdata('error', 'Payment Failure. Checksum mismatched.');
            redirect('user/profile');
            //Process transaction as suspicious.
        }


    }


}