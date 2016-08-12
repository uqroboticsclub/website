$(document).ready(function(){   
    setTimeout(function(){
        var sum = 0;
        var num = 0;
        $(".gal img").each(function(){
            sum += this.height;
            num++;
        })
        
        console.log("SUM: " + sum +  " NUM: " + num);
        
        $(".gal img").each(function(){
        	$(this).css({'height': (sum/num)});
            //this.height = (sum/num);
        });
    }, 1000);
    
    setTimeout(function(){
        var sum = 0;
        var num = 0;
        $(".gal2 img").each(function(){
            sum += this.height;
            num++;
        })
        
        console.log("SUM: " + sum +  " NUM: " + num);
        
        $(".gal2 img").each(function(){
        	$(this).css({'height': (sum/num)});
            //this.height = (sum/num);
        });
    }, 1000);
});

