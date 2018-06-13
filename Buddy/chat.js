function init()
{
  /*  ifr = document.getElementById("helper");
    msg2 = document.getElementById("msg");
    if(msg2.value!=null)
    {
        ifr.src = "http://localhost/Buddy/writemsg.php?msg=" + msg2.value;
    }
    */
	obj = new Chat();
	obj.msg = document.getElementById("msg");
	obj.divinnertop = document.getElementById("innertop");
  //  obj.ifr = document.getElementById("helper");
	obj.sendMsg();
	obj.listenMsg();
   
  
}
function update(data)
{
    alert(data);
}
function Chat()
{
 xhr=new XMLHttpRequest();
   // xhr.onreadystatechange=this.showoldMessage;
	this.sendMsg = function()
	{
        //obj.ifr.src="http://localhost/Buddy/writemsg.php?msg=" + obj.msg.value;
		
			xhr.open("get","http://localhost/Buddy/writemsg.php?msg="+obj.msg.value,true);
    		xhr.send();
		
     /*   newdiv = document.createElement("div");
		newdiv.innerHTML = "<span>Me:</span>" + obj.msg.value;
		obj.divinnertop.appendChild(newdiv);
       */ 
	}
	
	this.listenMsg = function()
	{		
		ev = new EventSource("http://localhost/Buddy/chatmsg.php");
		ev.addEventListener("newmsg", obj.showMessage, true);
	
		ev.addEventListener("oldmsg", obj.showoldMessage, true);
	}
	
	this.showMessage = function(event)
	{
		newdiv = document.createElement("div");
		newdiv.innerHTML =  event.data;
		obj.divinnertop.appendChild(newdiv);
	}
	this.showoldMessage = function(event)
	{
		newdiv = document.createElement("div");
		newdiv.innerHTML = event.data;
		obj.divinnertop.appendChild(newdiv);
	}
}
