<!--点赞打赏js代码开始-->
<script>
$(document).on('click', '.slzanpd',
	function() {
		var a = $(this),
		id = a.data('slzanpd');
		if (slzanpd_check(id)) {
			alert('您已赞过本文！');
		} else {
			$.post('', {
				plugin: 'slzanpd',
				action: 'slzan',
				id: id
			},
			function(b) {
				a.find('u').html(b);
				slzanpd_(a);
			});
			location.reload();
		}
	}
);
function slzanpd_check(id) {
	return new RegExp('slzanpd_' + id + '=true').test(document.cookie);
}
$('[data-slzanpd]').each(function() {
	var a = $(this),
	id = a.data('slzanpd');
	if (slzanpd_check(id)) {
		slzanpd_(a);
	} else {
		a.attr('title', '给作者来点动力吧！')
	}
});
function slzanpd_(a) {
	a.css('cursor', 'not-allowed').attr('title', '您已赞过本文！');
}
function dashangToggle(){
	$(".shang_box").fadeToggle();
}
function changeItem(i){
	var k = 3;
	for(var j = 0;j < k;j++){
		if(j == i){
			document.getElementById("sl_shang" + j).style.display = "block";
		}else{
			document.getElementById("sl_shang" + j).style.display = "none";
		}
	}
}
function opay(){
	document.getElementById("sl_shang").target="_parent";
}
</script>
<style>
.shang_box{width:300px;height:350px;margin:auto;padding:10px;background:#fff;border-radius:10px;position:fixed;z-index:1000;left:0;right:0;top:0;bottom:0;border:1px dotted #dedede;display:none;}
.dashang{display:block;width:160px;height:40px;line-height:40px;color:#fff;border-radius:3px;font-size:14px;text-align:center;float:left;margin:5px;}
.dashang{background:#66CC66;}
.shang_box a{color:#000!important;}
.dashang:hover{background:#666;}
#sl_shang0,#sl_shang1,#sl_shang2{text-align:center;margin:0 auto;width:150px;}
#sl_shang0 img,#sl_shang1 img,#sl_shang2 img{max-width:260px;}
.sl_shang{overflow:hidden;margin-bottom:50px;}.sl_shang b{font-size:18px;}
.sl_shang ul{margin-top:10px;clear:both;overflow:hidden;list-style:none;}
.sl_shang li{float:left;margin-left:10px;}
</style>
<!--点赞打赏js代码结束-->
<!--时间轴文章归档开始-->
<script type="text/javascript">
$(function(){
	$('.archives').find('ul').hide();
	$('.archives').find('ul:first').show();
	$('.archives h4').click(function(){
		$(this).next('ul').slideToggle("fast");
	})
})
</script>
<!--时间轴文章归档结束-->
<script>
    /*视频*/
	ajaxVideo();
    function ajaxVideo(){
		var videoObj = document.getElementsByClassName("MIAOPAI_player");
		for(var i=0;i<videoObj.length; i++){
			MiaopaiPlayer({
				"parent":videoObj[i],
				"width":"480px",
				"height":"480px",
				"autoplay":false,
				"title":"",
				"poster":videoObj[i].getAttribute('data-img'),
				"scid":videoObj[i].getAttribute('data-scid')
			});
		}
	};
	/*评论*/
	ajaxComment();
	function ajaxComment(){
		$("#commentform").submit(function(){
			$("#commentAlert").html("提交评论中……");
			$.ajax({
				type: $(this).attr("method"),
				url: $(this).attr("action"),
				data: $(this).serializeArray(),
				success: function(data) {
					var pattern = /<div class="main">[\r\n]+<p>(.*?)<\/p>/;
					if(pattern.test(data)) {
						arr = data.match(pattern);
						$("#commentAlert").html(arr[1]);
					}else{
						$("#commentAlert").html("评论成功，<?=Option::get('ischkcomment')=="y"&&ROLE == ROLE_VISITOR?"审核":"刷新";?>后可显示内容。");
					}
				},
				error: function(t) {
					$("#commentAlert").html("评论出错");
					window.location.reload();
				}
			});
			return false;
		});
	}
    /*下载分块儿滚动固定*/
    var top1=$('.cotentRight').height();
    var top2=$('.cotentRight').offset().top;
    var topNum=top1+top2;
    $(window).scroll(function(e) {
        var scroll_top=$(window).scrollTop();
        if(scroll_top>=topNum){
            $('.downLoadApp2').fadeIn(500);
        }else{
            $('.downLoadApp2').fadeOut(500);
        }
    });
    $('body').on('click','.MIAOPAI_player',function(e){
        var curSt = false;
        $(this).find('video').get(0).addEventListener('play',function () {
            curSt = true;
            for(i=0;i<$('video').length;i++){
                if(curSt && ($('video').get(i)!=this)){
                    $('video').get(i).pause();
                }
            }
        },false)
    })
</script>
<input type="hidden" id="login_code" value="<?=Option::get('login_code');?>" /> 
<script>
<!--登录框-->
$(document).delegate(".login","click",function(){
    $('.login_password').attr('type','password');
    $('.black_bg').width($(window).width()).height($(window).height()).fadeTo(0,0.4);
    $(".login_box").show();
	$.ajax({
		type: "post",
		url: "<?=TEMPLATE_URL;?>ajax/user.php",
		dataType: 'json',
		data: {"action":"getoauth"},
		success: function(data) {
			if(data.code=="ok") {
				$(".sina_login").attr("href",data.data.wb_url);
				$(".qq_login").attr("href",data.data.qq_url);
			}
		},
		error: function(t) {}
	});
});
$(".close_btn,.black_bg").click(function(){
    $(".black_bg").fadeOut();
    $(".login_box,.register_box").hide();
    $('.yzm_pic').hide();
});
/*********star 验证码*********/
/*随机reqid*/
var reqid='';
function randomId(phone){
    var timestamp=new Date().getTime();
    reqid=phone+'_'+timestamp;
    return reqid;
}
/*请求图片验证码*/
function picYzmAjaxR(phone,_this){
    reqid=randomId(phone);
    var imgUrl='<?=BLOG_URL;?>include/lib/checkcode.php?mode=t&reqid='+reqid;
    _this.attr('src',imgUrl);
}
/*初始图片验证码*/
function yzmCyrl(){
    var phoneVal=$('.login_name').val();
    var _this=$('#yzm_img');
    if(/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/.test(phoneVal)&&$("#login_code").val()=="y"){
        if($('.yzm_cont').is(':hidden')){
            $('.yzm_cont').show();
            picYzmAjaxR(phoneVal,_this);
        }else{
            return false;
        }
    }else{
        $('.yzm_input').val('');
        $('.yzm_cont').hide();
        return false;
    }
}
$('.login_name').keyup(function(){
    yzmCyrl();
});
$('.login_name').blur(function(){
    yzmCyrl();
});
/*图片验证码点击切换*/
$('#yzm_img').click(function(){
    var phoneVal=$('.login_name').val();
    var _this=$(this);
    picYzmAjaxR(phoneVal,_this);/*获取图片验证码*/
});
$(".login_btn").click(function(){
    var url="<?=TEMPLATE_URL;?>ajax/user.php";
    var isChecked=$("#remember_input").is(":checked");
	var ispersis=0;
	if(isChecked){
		ispersis=1;
	}
    var phones=$("#phone").val();
    var pwds=hex_md5($("#pwd").val());
    var phs=$("#ph").val();
    var cap=$('.yzm_input').val();
    var passwordVal=$("#pwd").val();
    var patternPhone=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
    if(!patternPhone.test(phones)){
		$("#loginAlert").html("邮箱格式有误");
        return false;
    }else if(passwordVal==''||(cap==''&&$("#login_code").val()=="y")){
		$("#loginAlert").html("密码或验证码不能为空");
        return false;
    }else{
		/*登录*/
		$.ajax({
			type: "post",
			url: url,
			dataType: 'json',
			data: {"action":"emaillogin","user":phones,"pw":passwordVal,"imgcode":cap,"ispersis":ispersis},
			success: function(data) {
				if(data.code=="success") {
					window.location.reload();
				}else{
					$("#loginAlert").html(data.msg);
				}
			},
			error: function(t) {
				$("#loginAlert").html("登陆请求错误");
			}
		});
    }
});
/***************end 验证码******/
<!--页脚二维码-->
$(".miaopai_ewm").mouseover(function(){
    $(this).siblings(".ewm_img").stop().fadeIn();
});
$(".miaopai_ewm").mouseout(function(){
    $(this).siblings(".ewm_img").stop().fadeOut();
});
/*注册-----------start------------------*/
    $('.yzmClose_btn').click(function () {
        $('.yzm_pic').hide();
        $(".black_bg").fadeOut();
    });
    /**/
    $('body').on('click','.reginster_btnChange',function () {
        $('.login_box').hide();
        $('.register_box').show();
        $('.reginster_input,.voiceYzm_val').val('');
    });
    /*登录切换*/
    $('body').on('click','.login_btnChange',function () {
        $('.register_box').hide();
        $('.login_box').show();
        $('.lawful_name,.login_name,.login_password,.yzm_input').val('');
    });
    /*图片验证，手机号验证，语音发送*/
    function infoRegAjax(phone,cap){
        var data={
			"action":"sendMailCode",
            "phone":phone,
            "reqid":reqid,
            "cap":cap,
            "version":"<?=INKER_VERSION;?>",
            "verifytype":1
        };
        $.ajax({
            url:'<?=TEMPLATE_URL;?>ajax/user.php',
            data:data,
			dataType: 'json',
            type:'POST'
        }).success(function(obj){
            if(obj.code!="ok"){
				$("#sendCodeAlert").html(obj.msg);
            }else if(obj.code=="ok"){
                /*验证通过发送语音*/
                $(".register_box").show();
                $(".yzm_pic").hide();
                showtime(60);
            }
        })
    }
    /*图片验证码点击更新*/
    $('.yzmPic_img img').click(function(){
        var yzmPicVal=$('#phoneReg').val();
        var _this=$(this);
        picYzmAjaxR(yzmPicVal,_this);//获取图片验证码
    });
    /*图片验证码提交*/
    $('body').on('click','#yzmLog_btn',function () {
        var cap=$('.yzmPic_input').val();
        var phoneReg=$('#phoneReg').val();
        $('#voiceYzmVal').val('');
        infoRegAjax(phoneReg,cap);
    });
    /*获取语音验证码倒计时*/
    var phone_b=$("#voiceYzmBtn");
    var timerX=null;
    function showtime(t){
        clearInterval(timerX);
        phone_b.attr('disabled',true); /*按钮不可用*/
        phone_b.addClass('voiceYzmBtn_no');
        timerX=setInterval(update_p(t),1000);
    };
    function update_p(t) {
        var num=0;
        return function(){
            num++;
            if(num == t){
                phone_b.val('重新发送');
                clearInterval(timerX);
                phone_b.attr('disabled',false); /*按纽可用*/
                phone_b.removeClass('voiceYzmBtn_no');
            }else{
                printnr = t-num;
                phone_b.val("("+printnr+")s后重新发送");
            }
        }
    };
/*获取语音验证码按钮点击*/
    $('body').on('click','#voiceYzmBtn',function () {
        var phoneReg=$('#phoneReg').val();
        var patternPhoneReg=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        var pwdReg=$('#pwdReg').val();
        var _this=$('.yzmPic_img img');
        if(!patternPhoneReg.test(phoneReg)){/*手机正则验证格式*/
			$("#regAlert").html('邮箱有误，请重新输入');
            return false;
        }else if(pwdReg.length<6){/*密码长度验证*/
			$("#regAlert").html('密码长度过低，请重新输入');
            return false;
        }else{
            /*显示图片验证码弹框*/
            $(".register_box").hide();
            $(".yzm_pic").show();
            $(".yzmPic_input").val('');
            /*获取图片验证码*/
            picYzmAjaxR(phoneReg,_this);
        }
    });
    /*注册异步*/
    var registerBool=true;/*控制短时间多次提交*/
    function loginZcAjax(phone,pwd,cap){
        var data={
			"action":"emailreg",
            "phone":phone,
            "pwd":pwd,
            "captcha":cap
        };
        $.ajax({
            url:'<?=TEMPLATE_URL;?>ajax/user.php',
            data:data,
			dataType: 'json',
            type:'POST',
        }).success(function(obj){
            if(obj.code=="ok"){
                $('.register_box').hide();
                $('.reginster_input,.voiceYzm_val').val('');
                /*登录*/
                $('.alert_status').show().delay(1000).fadeOut();
                $('.login_box').show();
            }else if(obj.code!="ok"){
                $("#regAlert").html(obj.msg);
            }
            registerBool=true;
        })
    };
    /*注册提交（验证手机：/^1[3|4|5|7|8][0-9]\d{8}$/）*/
    $('body').on('click','.reginster_btn',function () {
        var phoneReg=$('#phoneReg').val();
        var patternPhoneReg=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        var pwdReg=$('#pwdReg').val();
        var voiceYzmReg=$('#voiceYzmVal').val();
        if(!patternPhoneReg.test(phoneReg)){/*手机正则验证格式*/
			$("#regAlert").html('邮箱有误，请重新输入');
            return false;
        }else if(pwdReg.length<6){/*密码长度验证*/
			$("#regAlert").html('密码长度过低，请重新输入');
            return false;
        }else if(voiceYzmReg==''){/*验证码验证*/
			$("#regAlert").html('验证码不能为空');
            return false;
        }else{
            /*执行异步注册*/
            if(registerBool){
                registerBool=false;
                loginZcAjax(phoneReg,pwdReg,voiceYzmReg);
            }
        }
    });

/*注册-------end----------------------*/
</script>