$(function(){
	//全局的form验证
	$('#form').Validform({
		postonce : true,
		tiptype : function(msg,o,cssctl){
		//msg：提示信息;
		//o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
		//cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;
		if(!o.obj.is("form")){//验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;
			var objtip=o.obj.siblings(".Validform_checktip");
			objtip = $(objtip).get(0) == undefined ? o.obj.parent().next().find('.Validform_checktip') : objtip;
			objtip = $(objtip).get(0) == undefined ? o.obj.parents('td').find('.Validform_checktip') : objtip;
			objtip = $(objtip).get(0) == undefined ? o.obj.parents('td').next().find('.Validform_checktip') : objtip;
			if($(o.obj).attr('datatype') != 'verify'){
				cssctl(objtip,o.type);
				objtip.text(msg);
			}else{
				if($(o.obj).val().length != 5){
					cssctl(objtip,o.type);
					objtip.text(msg);
				}else{
					objtip.removeClass('Validform_wrong').text('');
				}
			}
		}
		},
		datatype:{
			'mix':function(gets,obj,curform,regxp){
				var lens = $(obj).attr('data-length');
				var str = $(obj).val();
				var realLength = 0, len = str.length, charCode = -1;
			    for (var i = 0; i < len; i++) {
			        charCode = str.charCodeAt(i);
			        if (charCode >= 0 && charCode <= 128) realLength += 1;
			        else realLength += 2;
			    }

			    if(realLength == 0){
			    	return false;
			    }
			    if(realLength > lens){
			    	return false;
			    }
			    return true;
			},
			'verify':function(gets,obj,curform,regxp){
				var str = $(obj).val();
				if(str.length < 5){
					return false;
				}else{
					return;
				}
			}
		}
    });
})