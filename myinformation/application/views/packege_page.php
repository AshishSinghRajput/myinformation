 <?php $this->load->view('layout/header');?>
 <style>
    .plan .plan-box{
    border: 2px solid #820506;
    border-radius: 10px;
    padding: 15px;
    margin:0 0 15px;
}
.plan .plan-box h1{
    color:#820506;
}
.plan .plan-box p{
    text-align:center;
}
.plan .plan-box button{
    background: #820506;
    color: #fff;
    padding: 15px 30px;
    border-radius: 50px;
    border: none;
    margin: 15px 0 0;
}
 </style>
 <section class="plan">
        <div class="container">
        <br>
            <div class="row">
            <?php 
                foreach ($plans as $row)
                {
                    $rand=rand(10000,9999999);
                    $secretKey = "013c73a309ddd46386133d487247e65a041c57b6";
                    $postData = array( 
                    "appId" => '4872fddddb4f1696606c65862784', 
                    "orderId" =>  $rand, 
                    "orderAmount" =>  $row->plan , 
                    "orderCurrency" => 'INR', 
                    "orderNote" => 'test', 
                    "customerName" => 'John Doe', 
                    "customerPhone" => 9999999999, 
                    "customerEmail" => 'sudheer@gmail.com',
                    "returnUrl" => site_url('welcome/returnurl'), 
                    "notifyUrl" => '',
                    );
                    // get secret key from your config
                    ksort($postData);
                    $signatureData = "";
                    foreach ($postData as $key => $value){
                        $signatureData .= $key.$value;
                    }
                    $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
                    $signature = base64_encode($signature);

                ?>
    <!-- <form id="redirectForm" method="post" action="https://test.cashfree.com/billpay/checkout/post/submit">
        <input type="hidden" name="appId" value="2096bae07189e75bdf5f15036902"/>
        <input type="hidden" name="orderId" value="order00003"/>
        <input type="hidden" name="orderAmount" value="<?= $row->plan ?>"/>
        <input type="hidden" name="orderCurrency" value="INR"/>
        <input type="hidden" name="orderNote" value="test"/>
        <input type="hidden" name="customerName" value="John Doe"/>
        <input type="hidden" name="customerEmail" value="sudheer@gmail.com"/>
        <input type="hidden" name="customerPhone" value="9999999999"/>
        <input type="hidden" name="returnUrl" value="<?= site_url('front/returnurl');?>"/>
        <input type="hidden" name="notifyUrl" value=""/>
        <input type="hidden" name="signature" value="<?= $signature ?>"/>
        <input type="submit" value="Buy">
    </form> -->
            <form id="redirectForm" method="post" <? if(!empty($this->session->userdata['user']['id'])){?> action="https://test.cashfree.com/billpay/checkout/post/submit" <?}else{?> action="plan_purchase" <?php  } ?>>
                <div class="col-md-4">
                    <div class="plan-box wow fadeInLeft">
                        <h1 class="text-center">
                            <i class="fa fa-inr"></i> <?= $row->plan ?>
                        </h1>
                        <input type="hidden" name="appId" value="4872fddddb4f1696606c65862784"/>
                        <input type="hidden" name="orderId" value="<?=  $rand;?>"/>
                        <input type="hidden" name="orderAmount" value="<?= $row->plan ?>"/>
                        <input type="hidden" name="orderCurrency" value="INR"/>
                        <input type="hidden" name="orderNote" value="test"/>
                        <input type="hidden" name="customerName" value="John Doe"/>
                        <input type="hidden" name="customerEmail" value="sudheer@gmail.com"/>
                        <input type="hidden" name="customerPhone" value="9999999999"/>
                        <input type="hidden" name="returnUrl" value="<?= site_url('welcome/returnurl');?>"/>
                        <input type="hidden" name="notifyUrl" value=""/>
                        <input type="hidden" name="signature" value="<?= $signature ?>"/>
                        <p><?= $row->p1 ?></p>
                        <p><?= $row->p2 ?></p>
                        <p><?= $row->p3 ?></p>
                        <p><?= $row->p4 ?></p> 
                        <!-- <input type="hidden" name="plan_amount" value="<?= $row->plan ?>"> -->
                        <p class="text-center">
                        
                        <button type="submit"> Buy</button>
                        </p>
                    </div>
                </div>
                </form>
                <?php } ?>
                

            </div>
        </div>
    </section>
     <?php $this->load->view('layout/footer');?>