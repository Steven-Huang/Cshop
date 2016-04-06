 <?php

 class PayAction extends Action {
 	private $messageId;//消息ID(唯一)
    private $verId; //版本号(初始1.0.0)
    private $instId;//机构标识
    private $certId;//数字证书标识
    private $flowNo;//流水号
    private $date;//交易日期和时间(YYYYMMDDHHMMSS)
    private $currency;//支付币种(只支持使用人民币（01）支付。取值：01)
    private $type;//交易类型(1支付; 2退款)
    
    /*订单查询*/
    private $accountNo;//支付账号(支付实体卡号或者其它账户)
    private $orderNo;//订单号(商户网站产生的一个唯一的定单号 )
    private $status;//支付状态(01：成功；02：失败；03：处理中；04：可疑；05：等待授权复核；默认不输入为空，全部 )
    private $beginDate;//起始日期(YYYYMMDD)
    private $endDate; //截止日期(YYYYMMDD)
    private $queryPage;//查询第几页(数据量大时，使用该字段分页。首次查询时为1)
    private $orderTime;//订单日期(YYYYMMDDHHMMSS)
    private $orderAmt;//客户支付订单的总金额，以分为单位。金额为123.45比如：12345
    private $cardType;//银行卡类型(D代表借记卡；C代表贷记卡；O其他)
    private $autoJump;//是否自动跳转到商城页面(0：不跳转 1：跳转)
    
    /*支付*/
    private $jumpWaitTime;//跳转前等待时间(以秒为单位，至少5秒；如果自动跳转，必须输入)
    private $merURL;//商户商城URL(需要跳转时，必输支付成功后，客户的浏览器自动转到该URL)
    private $notifyUrl;//商户通知URL(将支付结果签名后发送到商户指定的URL（注：URL不跳转）)
    private $goodsName;//商品名称(非必须)
    private $goodsNum;//商品数量(非必须)
    private $remark;//备注信息(非必须)
    private $rem1;//预留字段1(非必须)
    private $rem2;//预留字段2(非必须)
    
    /*退款*/
    private $charge;//手续费(以分为单位。金额为123.45比如：12345)
    private $amount;//交易金额(以分为单位。金额为123.45比如：12345)
    private $originalOrderNo;//原支付流水号(对应原支付订单号)
    private $originalDate;//原交易日期(对应原支付日期,格式YYMMDD)
    private $originalTime;//原交易时间(对应原支付时间，格式HHMMss)
    
    /*单笔实时查询*/
    private $checkFlowNo;//待查询订单流水号(需要查询的交易流水号)
    
    /*批量查询请求*/
    private $checkFlowNoList;//待查询订单流水号列表(需要查询的交易流水号列表，包含多个< flowNo >信息)
    private $batchNotifyUrl;//批量结果通知URL(将查询结果签名后发送到商户指定的URL)
    
    public function __construct() {
    	parent::__construct();
        $this->key="";//签名验证密钥
        $this->merchantNo = "";//商户号(需申请，常量)  
        $this->merchantNo = "";
        $this->messageId = '';
        $this->verId = '1.0.0';
        $this->instId = '';
        $this->certId = '';
        $this->date = '';
        $this->currency = '';
        $this->type = '';
        $this->accountNo = '';
        $this->orderNo = '';
        $this->status = '';
        $this->beginDate = '';
        $this->endDate = '';
        $this->queryPage = '';
        $this->orderTime = '';
        $this->orderAmt = '';
        $this->cardType = '';
        $this->autoJump = '';
        $this->jumpWaitTime = '';
        $this->merURL = '';
        $this->notifyUrl = '';
        $this->goodsName = '';
        $this->goodsNum = '';
        $this->remark = '';
        $this->rem1 = '';
        $this->rem2 = '';
        $this->charge = '';
        $this->amount = '';
        $this->originalOrderNo = '';
        $this->originalDate = '';
        $this->originalTime = '';
        $this->checkFlowNo = '';
        $this->checkFlowNoList = '';
        $this->batchNotifyUrl = '';
        $this->operateFlag = '';
        $this->phoneNo = '';
        $this->phoneNoEnc = '';
    }
    
    //支付报文
    public function EBPReq($openid,$orderNo,$orderTime,$orderAmt,$goodsName,$goodsNum,$remark,$operateFlag,$phoneNo,$phoneNoEnc){
        $this->messageId='';
        $this->verId='1.0.0';
        $this->orderNo=$orderNo;
        $this->orderTime=$orderTime;
        $this->orderAmt=$orderAmt;
        $this->cardType='C';
        $this->merURL=''.$orderNo;
        $this->notifyUrl='';
        $this->goodsName=$goodsName;
        $this->goodsNum=$goodsNum;
        $this->remark=$remark;
        $this->rem1='00';

        if($phoneNo){
            $this->operateFlag = $operateFlag;
            $this->phoneNo = $phoneNo;
            $this->phoneNoEnc = $phoneNoEnc;
        }

        //未加密报文(不能有任何其他字符，包括空格与回车符)
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><EBPReq id="EBPReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><orderNo>'.$this->orderNo.'</orderNo><orderTime>'.$this->orderTime.'</orderTime><orderAmt>'.$this->orderAmt.'</orderAmt><currency>01</currency><cardType>'.$this->cardType.'</cardType><autoJump>1</autoJump><jumpWaitTime>10</jumpWaitTime><merURL>'.$this->merURL.'</merURL><notifyUrl>'.$this->notifyUrl.'</notifyUrl><goodsName>'.$this->goodsName.'</goodsName><goodsNum>'.$this->goodsNum.'</goodsNum><remark>'.$this->remark.'</remark><tranType>'.$this->rem1.'</tranType><operateFlag>'.$this->operateFlag.'</operateFlag><phoneNo>'.$this->phoneNo.'</phoneNo><phoneNoEnc>'.$this->phoneNoEnc.'</phoneNoEnc></EBPReq></Message></CSRCEBankData>';
        
        //报文消息体MD5加密
        $sigNature=md5($postData.$this->key);
        
        //报文添加加密签名
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><EBPReq id="EBPReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><orderNo>'.$this->orderNo.'</orderNo><orderTime>'.$this->orderTime.'</orderTime><orderAmt>'.$this->orderAmt.'</orderAmt><currency>01</currency><cardType>'.$this->cardType.'</cardType><autoJump>1</autoJump><jumpWaitTime>10</jumpWaitTime><merURL>'.$this->merURL.'</merURL><notifyUrl>'.$this->notifyUrl.'</notifyUrl><goodsName>'.$this->goodsName.'</goodsName><goodsNum>'.$this->goodsNum.'</goodsNum><remark>'.$this->remark.'</remark><tranType>'.$this->rem1.'</tranType><operateFlag>'.$this->operateFlag.'</operateFlag><phoneNo>'.$this->phoneNo.'</phoneNo><phoneNoEnc>'.$this->phoneNoEnc.'</phoneNoEnc><Signature>'.$sigNature.'</Signature></EBPReq></Message></CSRCEBankData>';
        
        return $postData;
    }
    
    //订单列表查询
    public function OLQReq($messageId,$verId,$instId,$certId,$date,$accountNo,$orderNo,$status,$beginDate,$endDate,$queryPage){
        $this->messageId=$messageId;
        $this->verId=$verId;
        $this->certId=$certId;
        $this->date=$date;
        $this->accountNo=$accountNo;
        $this->orderNo=$orderNo;
        $this->status=$status;
        $this->beginDate=$beginDate;
        $this->endDate=$endDate;
        $this->queryPage=$queryPage;
        $this->instId=$instId;
       
        //未加密报文(不能有任何其他字符，包括空格与回车符)
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><OLQReq id="OLQReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><instId>'.$this->instId.'</instId><certId>'.$this->certId.'</certId><date>'.$this->date.'</date><accountNo>'.$this->accountNo.'</accountNo><orderNo>'.$this->orderNo.'</orderNo><status>'.$this->status.'</status><beginDate>'.$this->beginDate.'</beginDate><endDate>'.$this->endDate.'</endDate><queryPage>'.$this->queryPage.'</queryPage></OLQReq></Message></CSRCEBankData>';
    
        //报文消息体MD5加密
        $sigNature=md5($postData.$this->key);
    
        //报文添加加密签名
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><OLQReq id="OLQReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><instId>'.$this->instId.'</instId><certId>'.$this->certId.'</certId><date>'.$this->date.'</date><accountNo>'.$this->accountNo.'</accountNo><orderNo>'.$this->orderNo.'</orderNo><status>'.$this->status.'</status><beginDate>'.$this->beginDate.'</beginDate><endDate>'.$this->endDate.'</endDate><queryPage>'.$this->queryPage.'</queryPage></OLQReq><Signature>'.$sigNature.'</Signature></Message></CSRCEBankData>';
    
        return $postData;
    }
    
    //订单明细查询请求
    public function ODQReq($messageId,$verId,$instId,$certId,$date,$flowNo){
        $this->messageId=$messageId;
        $this->verId=$verId;
        $this->instId=$instId;
        $this->certId=$certId;
        $this->date=$date;
        $this->flowNo=$flowNo;
         
        //未加密报文(不能有任何其他字符，包括空格与回车符)
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><ODQReq id="ODQReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><instId>'.$this->instId.'</instId><certId>'.$this->certId.'</certId><date>'.$this->date.'</date><flowNo>'.$this->flowNo.'</flowNo></ODQReq></Message></CSRCEBankData>';
    
        //报文消息体MD5加密
        $sigNature=md5($postData.$this->key);
    
        //报文添加加密签名
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><ODQReq id="ODQReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><instId>'.$this->instId.'</instId><certId>'.$this->certId.'</certId><date>'.$this->date.'</date><flowNo>'.$this->flowNo.'</flowNo></ODQReq><Signature>'.$sigNature.'</Signature></Message></CSRCEBankData>';
    
        return $postData;
    }
    
    //退款报文
    public function SRReq($messageId,$verId,$instId,$certId,$flowNo,$date,$charge,$amount,$currency,$originalOrderNo,$originalDate,$originalTime){
        $this->messageId=$messageId;
        $this->verId=$verId;
        $this->instId=$instId;
        $this->certId=$certId;
        $this->flowNo=$flowNo;
        $this->date=$date;
        $this->charge=$charge;
        $this->amount=$amount;
        $this->currency=$currency;
        $this->originalOrderNo=$originalOrderNo;
        $this->originalDate=$originalDate;
        $this->originalTime=$originalTime;
        
        //未加密报文(不能有任何其他字符，包括空格与回车符)
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><SRReq id="SRReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><instId>'.$this->instId.'</instId><certId>'.$this->certId.'</certId><flowNo>'.$flowNo.'</flowNo><date>'.$this->date.'</date><charge>'.$this->charge.'</charge><amount>'.$this->amount.'</amount><currency>'.$this->currency.'</currency><originalOrderNo>'.$this->originalOrderNo.'</originalOrderNo><originalDate>'.$this->originalDate.'</originalDate><originalTime>'.$this->originalTime.'</originalTime></SRReq></Message></CSRCEBankData>';
    
        //报文消息体MD5加密
        $sigNature=md5($postData.$this->key);
    
        //报文添加加密签名
        $postData ='<CSRCEBankData><Message id="'.$this->messageId.'"><SRReq id="SRReq"><version>'.$this->verId.'</version><merchantNo>'.$this->merchantNo.'</merchantNo><instId>'.$this->instId.'</instId><certId>'.$this->certId.'</certId><flowNo>'.$flowNo.'</flowNo><date>'.$this->date.'</date><charge>'.$this->charge.'</charge><amount>'.$this->amount.'</amount><currency>'.$this->currency.'</currency><originalOrderNo>'.$this->originalOrderNo.'</originalOrderNo><originalDate>'.$this->originalDate.'</originalDate><originalTime>'.$this->originalTime.'</originalTime></SRReq><Signature>'.$sigNature.'</Signature></Message></CSRCEBankData>';
    
        return $postData;
    }


 }