function init() {
	obj = new NewsFeed();

	obj.scrTimer = null;
	obj.feedTimer = null;

	obj.feeds = new Array();

	obj.divouter = document.getElementById("outer");
	obj.divinner = document.getElementById("inner");

	obj.divinner.style.position = "fixed";
	obj.divinner.style.left = window.innerWidth - 5 + "px";

	obj.scroll();

	obj.feedTimer = setTimeout(obj.getFeeds,4000);
    }



NewsFeed.prototype.getFeeds = function() {
	$.ajax( {
		url: "http://localhost/Buddy/rss3/getFeeds.php",
		type: "GET",
		data: {},
		dataType: "xml",
		success: obj.showFeeds,
		error: obj.showError
	 }
	);

	obj.feedTimer = setTimeout(obj.getFeeds, 8000);
}

function NewsFeed() {
	this.scroll = function() {
		if((obj.divinner.offsetLeft + obj.divinner.offsetWidth) < 0 ) {
			obj.divinner.style.left = window.innerWidth - 5 +"px";
		}
		obj.divinner.style.left = obj.divinner.offsetLeft - 5 +"px";

		obj.divinner.onmouseover = obj.stopScroll;
		obj.divinner.onmouseout = obj.scroll;

		obj.scrTimer = setTimeout(obj.scroll,100);
	}

	this.stopScroll = function() {
		if(obj.scrTimer) {
			clearTimeout(obj.scrTimer);
		}
	}
	this.showFeeds = function(xmldom) {
		rssnode = xmldom.documentElement;
		items = rssnode.getElementsByTagName("item");

		obj.divinner.innerHTML = "";

		for(i=0;i<3;i++) {
			title = items[i].getElementsByTagName("title")[0];
			link = items[i].getElementsByTagName("link")[0];
			
			newitem = new NewsFeedItem(link.firstChild.nodeValue,title.firstChild.nodeValue)
			obj.feeds.push(newitem);	

			obj.divinner.appendChild(newitem.anchor);
			obj.divinner.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
		}
	}
}

function NewsFeedItem(link,title) {
	this.anchor = document.createElement("a");
	this.anchor.innerHTML = title;
	this.anchor.href = link;
}
