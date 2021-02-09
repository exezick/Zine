var videos = {
	scan: function()
	{
        var confirmS = confirm("Scan videos in directories, Click ok to make changes.");
		if(confirmS === true)
		{
            $.ajax({
                type: "post",
                url: URL+"index.php/videos/scan_videos",
                data:{
                    'arraydata' : ''
                },
                success: function(scn)
                {
                    alert("Success fully scanned! Changes have been made, click ok to reload.");
                    location.replace(URL);
                }
            });
        }
	}
};