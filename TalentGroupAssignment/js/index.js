// $('.main-nav ul li .picture').mouseover(function() {
//   $('.main-nav ul li .picture').removeClass('active');
//   $(this).addClass('active');
// });


// function bindAvatar1() {
// $("#avatarSlect").change(function () {
// 	var csrf = $("input[name='csrfmiddlewaretoken']").val();
// 	var formData=new FormData();
// 	formData.append("csrfmiddlewaretoken",csrf);
// 	formData.append('avatar', $("#avatarSlect")[0].files[0]);  /*获取上传的图片对象*/
// 	$.ajax({
// 	  url: '/upload_avatar/',
// 	      type: 'POST',
// 	      data: formData,
// 	      contentType: false,
// 	      processData: false,
// 	      success: function (args) {
// 	    console.log(args);  /*服务器端的图片地址*/
// 	          $("#avatarPreview").attr('src','/'+args);  /*预览图片*/
// 	          $("#avatar").val('/'+args);  /*将服务端的图片url赋值给form表单的隐藏input标签*/
// 	 }
// 	})
// })
// }
function PreviewImage(imgFile)
{
    var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
    filextension=filextension.toLowerCase();
    if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp')){
	    alert("Please select photo fomate!");
	    imgFile.focus();
    }
    else{
	    var path;
	    if(document.all)//IE
	    {
		    imgFile.select();
		    path = document.selection.createRange().text;
		   
		    document.getElementById("imgPreview").innerHTML="";
		    document.getElementById("imgPreview").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";
	    }
	    else//FF
	    {
		    path = window.URL.createObjectURL(imgFile.files[0]);
		    document.getElementById("imgPreview").innerHTML = "<img  src='"+path+"'/>";
	    }
    }
}


