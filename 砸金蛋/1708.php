<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
<title>嗨“翻”双十二，加量不加价！</title>
<? $path = '/style/css/events/2017/1707/'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">

    <link rel="stylesheet" type="text/css" href="<?= $path ?>index.css">
</head>

<body>
<div class="box">
  <div class="box_margin">
    <div class="project " id="card1">
        <div class="mask">
            <div class="front"><img src="<?= $path ?>back.jpg"></div>
            <div class="back"><img src="<?= $path ?>front12.jpg"></div>
        </div>
    </div>
    <div class="project " id="card2">
        <div class="mask">
            <div class="front"><img src="<?= $path ?>back.jpg"></div>
            <div class="back"><img src="<?= $path ?>front24.jpg"></div>
        </div>
    </div>
    <div class="project " id="card3">
        <div class="mask">
            <div class="front"><img src="<?= $path ?>back.jpg"></div>
            <div class="back"><img src="<?= $path ?>front48.jpg"></div>
        </div>
    </div>
    <div class="project " id="card4">
        <div class="mask">
            <div class="front"><img src="<?= $path ?>back.jpg"></div>
            <div class="back"><img src="<?= $path ?>front72.jpg"></div>
        </div>
    </div>
    <div id="start"><p>点击开始翻牌</p><img src="<?= $path ?>jt.png"></div>
	 <div id="info">
	    <p>剩余<i class="red"><?php echo $chance;?></i>抽奖机会; 一共抽中了<i class="red"><?php echo $G;?></i>G币; 还差<i class="red"><?php echo $Once_again;?></i>可以再抽取一次</p>
	 </div>
	<div class="tj">共获得：<i class="red"><?php echo $G;?>G币</i></div>
	<div class="rule_z">
		<div class="rule">
			<p class="big">来了，来了，我们又来了！</p>
	 		<p class="big">双十一刚走，双十二又来了！</p>
			<p class="small" style="margin-top:20px;">上次的活动结束后，众多玩家老爷反馈，狂“翻”的方式终于使手指的点击速度有了用武之地，所以这一次管他什么活动，管他什么福利，我们还是继续来翻牌吧。毕竟淘宝抢购吓人，天猫购物太贵，还是翻牌最实惠！</p>
			<p class="small">1、活动期间内，在任意一款平台页游中累积充值<i class="red">100RMB</i>（不包括G币），便可参加一次翻牌；</p>
			<p class="small">2、参与翻牌次数不限，奖励将在活动结束后的一周内发放；</p>
			<p class="small">3、若活动页面无法响应，请更新浏览器，或更改浏览器模式（兼容/极速）。</p>
			<i class="last">(活动页面右下角可查看累积获取的G币总额)</i>

		</div>
	</div>
	<div class="erweima">
		<img src="<?= $path ?>erweima.png" style="margin-top:30px;"/>	
		<p style="color:#d6af05;margin-top:10px;letter-spacing:6px;">手机扫描二维码</p>	
		<p style="color:#d6af05;margin-top:10px;letter-spacing:1px;">可直接访问游戏风云</p>	
	</div>
	<div class="footer">
		<p>All Rights Reserved. 上海游戏风云文化传媒有限公司 版权所有 沪ICP备06061673号</p>
	         <p>网络文化经营许可证：文网文【2010】0387-014号 广播电视节目制作经营许可证：（沪）字第177号 增值电信业务经营许可证：沪B2-20110001</p>
	         <p>Powered by gamefy.cn</p>
	</div>
	<div class="islogin">
		<p class="red"></p>
	</div>
    </div>
</div>

<script type="text/javascript" src="<?= $path ?>jquery.js"></script>
<script type="text/javascript">

$(function(){
	isLogin();
  var click_count = 1;
  var info ={
      chance : "",
      G:"",
      Once_again:""
  }
	//从后台数据获取到数据展示在页面上
	info.addhtml = function (){
	    var html = '';
	    html += '<div id="info">';
	    html += '<p>剩余<i class="red">' + info.chance +'</i>次抽奖机会; 一共抽中了<i class="red">'+ info.G +'</i>G币; 还差<i class="red">'+ info.Once_again +'</i>就可以再抽一次 </p>';
	    html += '</div>';
	    html += '<div class="tj">共获得：'+ info.G +'G币</div>'
	    $(".box_margin").append(html);
	}
	//移除html
	info.removehtml = function(){
	    $("#info").remove();
	}

	// 设置触发翻牌效果触发点
	$("#start").click(function(){ startroll() })
	$('.project').click(function(){ startroll() })


	function startroll () {
		isLogin();
		if( $(".islogin p").text()!= "您当前未登录！" && $(".islogin p").text()!= "活动未开始！" && $(".islogin p").text()!= "活动已结束！" ){
			$(".result").remove();
			loading()
			if( info.chance == 0){
				alert('您还不能抽奖！')
			}else{
				$(".mask .back").css({'transform':' rotateY(180deg)'});
				$(".mask .front").css({'transform':'rotateY(0deg)'});
				addMove();
			}
		}else if( $(".islogin p").text()== "活动未开始！"){
			console.log( $(".islogin p").text());
		}
	}

	//用户是否登录
	function isLogin(){
		$.ajax({
			url:"/events/event201712/getStatus",
			async:false,
			type:"GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success:function(res){
				if(res.status  == -3){
					$(".islogin p").text('您当前未登录！');
					alert("您当前未登录！");
					window.location.href = "/register?preurl=events/events2017/event_1707";
					return ;
				}else if(res.status  == -1){
					$(".islogin p").text('活动未开始！');
					alert("活动未开始！！");
					return;
				}else if(res.status  == -2){
					$(".islogin p").text('活动已结束！')
					alert("活动已结束！！")
				}
			}
		});
	}

  //获取数据
  function loading(){
      $.ajax({
          url:"/events/event201712/getUserInfo",
   type:"GET",
          async:false,
          dataType: "json",
          contentType: "application/json; charset=utf-8",
          success:function(result){
              info.chance = result.chance;
              info.G =  result.G;
              info.Once_again = result.Once_again;
          }
      });
  }

  function addMove(){
		$('.project').unbind("click");
    $('.project').each(function(index,item){
        setTimeout(function(){
            $(item).addClass('ani_sou');
        },index*100)
    })
    setTimeout(function(){
        $('.project').each(function(index,item){
            $(item).removeClass('ani_sou');
        })
    },1500)

    var left1 = 34;
    var left2 = 273;
    var left3 = 512;
    var left4 = 751;


    var arr = [];
    arr.push(left1,left2,left3,left4)

    var repeat = 15;
    var time = setInterval(function(){
        if(repeat == 0 ){
            clearInterval(time)
        }else{
            repeat --;
            sort();
        }
    },600);

    function sort(){
        var crr = arr.concat()   //深复制数组准备工作
        arr.sort(function(){
            return (0.5-Math.random());
        })

        var mergeArr = crr.map(function(item,index){
            if(item == arr[index]){
                return item
            }
            return 'A'
        })

        mergeArr.indexOf('A') == -1 && sort()

        $('.project').each(function(index,item){
            for(var i = 0 ; i < arr.length; i++){
                $('.project').eq(0).css({'position':'absolute', 'left':+ arr[0] +'px'})
                $('.project').eq(1).css({'position':'absolute', 'left':+ arr[1] +'px'})
                $('.project').eq(2).css({'position':'absolute', 'left':+ arr[2] +'px'})
                $('.project').eq(3).css({'position':'absolute', 'left':+ arr[3] +'px'})
            }
        })
      }

      var click_count = 1;
      var click_count2 = click_count;

      //开始抽奖
      $(".box_margin .project").click(function(){
          var index = $(this).index();
          if( click_count == 0){
              alert('不能再翻牌了！')
          }else if(click_count2 !=0){
              click_count2 -= click_count2 ;
              $(".box_margin .project").eq(index).children().find('.back').css({'transform':' rotateY(0deg)'})
              $(".box_margin .project").eq(index).children().find('.front').css({'transform':' rotateY(180deg)'})
              $.ajax({
                  url:"/events/event201712/get_rate",
                  type:"GET",
                  async:false,
                  dataType: "json",
                  contentType: "application/json; charset=utf-8",
                  success:function(result){
                     $(".box_margin .project").eq(index).children().find(".back").html("<img src='<?= $path ?>front"+result.probability+".jpg'/>")
                      info.removehtml();
                      info.chance = result.chance;
                      info.G = result.G;
                      info.Once_again =result.Once_again
                      info.addhtml();
											$('.project').click(function(){ startroll() })
                  }
              });
          }
      })
  }
})

</script>


</body>
</html>
