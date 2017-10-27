<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel='stylesheet' type="text/css" href="__PUBLIC__/css/style.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.min.js"></script>
<script type="text/javascript">
	var data_path = "__DATA__";
	var tpl_public = "__PUBLIC__";
</script>
<script type="text/javascript" src="__PUBLIC__/js/jBox.config.js"></script>
<script type="text/javascript">
	$(function(){

		setStyleSelect('1');//默认样式选择

		$("#form_do").submit(function(){
			var name = $("input[name='name']");
			if($.trim(name.val())==''){
				name.parent().find("span").remove().end().append("<span class='error'>名称不能为空</span>");
				return false;			
			}else {
				name.parent().find("span").remove().end();
			}

		});


		$("input[name='type']").click(function(){
            //var inputs = $(this).parents('dl').find('dt');
            var dl = $(this).parents('dl').next();//.find('dt');
          
            
            if($(this).attr('checked')) {
                dl.find('dt').html('链接地址：');
                dl.find('span').hide();
                //var inputParent = $(this).parents('.app').find('p>input');    
 

            }else {
            	dl.find('dt').html('别名(拼音)：');
            	dl.find('span').show();
            }
            
        });



        $("select[name='modelid']").change(function(){
        	
			$("select[name='modelid'] option").each(function(i,o){
			if($(this).attr("selected")){
				//$(".city").hide();
				//$(".city").eq(i).show();
				var styleid = $(this).val();
				setStyleSelect(styleid);
				
			}
			});
		});
		
		function setStyleSelect(id){
			var template_list = $("select[name='template_list']");
        	var template_show = $("select[name='template_show']");
			switch (id){
				<?php if(is_array($mlist)): foreach($mlist as $key=>$v): ?>case '<?php echo ($v["id"]); ?>':
					template_list.val("<?php echo ($v["template_list"]); ?>");
					template_show.val("<?php echo ($v["template_show"]); ?>");
				 	break;<?php endforeach; endif; ?>
			}

		}

    });
</script>

<script type="text/javascript">
$(function () {
	//缩略图上传
	var litpic_tip = $(".litpic_tip");
	var btn = $(".litpic_btn span");
	$("#fileupload").wrap("<form id='myupload' action='<?php echo U(GROUP_NAME. '/Public/upload', array('tb' => 2));?>' method='post' enctype='multipart/form-data'></form>");
    $("#fileupload").change(function(){
    	if($("#fileupload").val() == "") return;
		$("#myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		$('#litpic_show').empty();
				btn.html("上传中...");
    		},
			success: function(data) {
				//litpic_tip.html("<b>"+data.title+"("+data.size+"k)</b> <span class='delimg' rel='"+data.url+"'>删除</span>");
				if(data.state == 'SUCCESS'){					
					litpic_tip.html(""+ data.title +" 上传成功("+data.size+"k)");
					var img = data.url;//原图
					var timg = data.turl;//缩略图
					$('#litpic_show').html("<img src='"+timg+"' width='120'>");
					$("#litpic").val(timg);
				}else {
					litpic_tip.html(data.state);		
				}			
					btn.html("添加图片");

			},
			error:function(xhr){
				btn.html("上传失败");
				litpic_tip.html(xhr);
			}
		});
	});

	$('#CK_JumpUrl').click(function(){
            var inputs = $(this).parents('dl').find('input');
            if($(this).attr('checked')) {
                $('#JumpUrlDiv').show();

            }else {
                $('#JumpUrlDiv').hide();
            }
            
     });
	
});




$(function () {

	$('#BrowerPicture').click(function(){
		$.jBox("iframe:<?php echo U(GROUP_NAME.'/Public/browseFile', array('stype' => 'picture'));?>",{
			title:'ZHTXCMS',
			width: 650,
   			height: 350,
    		buttons: { '关闭': true }
   			}
		);
	});	

});


function selectPicture(sfile) {
	$.jBox.tip("选择文件成功");
	$.jBox.close(true);
	$("#litpic").val(sfile);
	$('#litpic_show').html("<img src='"+sfile+"' width='120'>");
}



</script>

</head>
<body>
<div class="main">
    <div class="pos">添加栏目</div>
	<div class="form">
		<form method='post' id="form_do" name="form_do" action="<?php echo U(GROUP_NAME.'/Category/add');?>">
		<ul class="tabnav">
			<li id="tab_setting_1" onclick="switchTab('setting','on',3,1);" class="on">基本选项</li>
			<li id="tab_setting_2" onclick="switchTab('setting','on',3,2);">高级设置</li>
			<li id="tab_setting_3" onclick="switchTab('setting','on',3,3);">权限设置</li>
		</ul>
		<div id="div_setting_1">
		<dl>
			<dt> 所属栏目：</dt>
			<dd>
				<select name="pid">
					<option value="0">顶级栏目</option>
					<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($pid == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo ($v["delimiter"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>		
		<dl>
			<dt> 内容模型：</dt>
			<dd>
				<select name="modelid">
					<?php if(is_array($mlist)): foreach($mlist as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt> 栏目名称：</dt>
			<dd>
				<input type="text" name="name" class="inp_one" />
			</dd>
		</dl>
		<dl>
			<dt>外部链接</dt>
			<dd>
				<input type="checkbox" name="type" value="1" />外部链接
			</dd>
		</dl>

		<dl>
			<dt>别名(拼音)：</dt>
			<dd>
				<input type="text" name="ename" class="inp_one" /><span>只能包含字母，数字</span>
			</dd>
		</dl>	

		<dl>
			<dt>栏目图片：</dt>
			<dd>
				<div class="litpic_show">
				    <div style="float:left;">
				    <input type="text" class="inp_w250" name="catpic" id="litpic"  value="" />
				    <input type="button" class="btn_blue_b" id="BrowerPicture" value="选择站内图片">
				    </div>
						<div class="litpic_btn">
				        <span>添加图片</span>
				        <input id="fileupload" type="file" name="mypic">
				    </div>
				    <div class="litpic_tip"></div>
				    <div id="litpic_show"> </div>
				</div>
			</dd>
		</dl>		
		<dl>
			<dt> 排序：</dt>
			<dd>
				<input type="text" name="sort" class="inp_one" value="1" />
			</dd>
		</dl>
		<dl>
			<dt> 是否上线：</dt>
			<dd>
				<input type="radio" name="status" value="1" checked="checked"/>上线
				<input type="radio" name="status" value="0"/>下线
			</dd>
		</dl>
		<dl>
			<dt> 导航显示：</dt>
			<dd>
				<input type="radio" name="isnav" value="1" checked="checked"/>显示
				<input type="radio" name="isnav" value="0"/>隐藏
			</dd>
		</dl>

		</div>

		<div id="div_setting_2" style="display:none;">		
		<dl>
			<dt>栏目模板：</dt>
			<dd>
				<select name="template_list">
					<?php if(is_array($styleListList)): foreach($styleListList as $key=>$v): ?><option value="<?php echo ($v); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>内容页模板：</dt>
			<dd>
				<select name="template_show">
					<?php if(is_array($styleShowList)): foreach($styleShowList as $key=>$v): ?><option value="<?php echo ($v); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>

		<dl>
			<dt> Seo标题：</dt>
			<dd>
				<input type="text" name="seotitle" class="inp_one" />
			</dd>
		</dl>
		<dl>
			<dt> 关键词：</dt>
			<dd>
				<input type="text" name="keywords" class="inp_one" />
			</dd>
		</dl>
		<dl>
			<dt> 栏目描述：</dt>
			<dd>
				<textarea name="description" class="tarea_default"></textarea>
			</dd>
		</dl>
		</div>

		<div id="div_setting_3" style="display:none;">
			<dl>
				<dt>管理员组权限</dt>
				<dd>
					<table class="t-list">
					  <tr>
					    <th>管理员组名称</th>
					    <th>查看</th>				    
					    <th>添加</th>				    
					    <th>修改</th>				    
					    <th>删除</th>
					    <th>移动</th>		    
					    <th>回收站</th>	    
					    <th>还原</th>	    
					    <th>清除</th>

					  </tr>
					  <?php if(is_array($roleList)): foreach($roleList as $key=>$v): ?><tr>
					    <td><?php echo ($v["name"]); ?></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="index,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="add,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="edit,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="del,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="move,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="trach,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="restore,<?php echo ($v["id"]); ?>" /></td>
					    <td align="center"><input type="checkbox" name="acc_roleid[]" value="clear,<?php echo ($v["id"]); ?>" /></td>
					  </tr><?php endforeach; endif; ?>
					</table>
					
				</dd>
			</dl>
			<dl>
				<dt>会员组权限</dt>
				<dd>
					<table class="t-list">
					  <tr>
					    <th>会员组名称</th>
					    <th>允许访问</th>
					  </tr>
					  <?php if(is_array($groupList)): foreach($groupList as $key=>$v): ?><tr>
					    <td><?php echo ($v["name"]); ?></td>
					    <td align="center"><input type="checkbox" name="acc_groupid[]" value="visit,<?php echo ($v["id"]); ?>" /></td>
					  </tr><?php endforeach; endif; ?>
					</table>
					
				</dd>
			</dl>
		</div>

		</div>
		<div class="form_b">
			<input type="submit" class="btn_blue" id="submit" value="提 交">
		</div>
	   </form>
	</div>


</body>
</html>