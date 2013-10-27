<?php $cakeDescription = "ljn";?>
<?php
echo "<pre>";
print_r($this->Authake->getUserEMail());
echo "</pre>";

?>
<table id="search" border=0>
    <tr>
        <td style="width:180px">
            <img src="img/google_color.png" alt="Home" width="116" id="logo">
        </td>
        <td style="width:600px">
            <form action="https://www.google.se/search" metod="get" id="search_form">
                <input type="text" id="gbqfq" name="q" class="gbqfif"/>
                <input type="image" src="img/search_button.png" id="search_button" name="search_button" style="""/>
            </form>
        </td>
        <td style="text-align: right; padding-right: 20px"><a href="#" id="addWidgetLink">Add widget</a>
			<table border=1><tr>

						</tr>
				</table>
		</td>
    </tr>
</table>

<div id="columns">
    <ul id="column0" class="column"></ul>
    <ul id="column1" class="column"></ul>
    <ul id="column2" class="column"></ul>
</div>

<div id="dialog" title="Add Widget" style="display: none"></div>
<div class="clear"></div>
<div id="footer_wrap">
    <div id="footer_content">
        iGiggle &copy;<a href="http://www.fahlstad.se">Fredrik Fahlstad</a> 2013
    </div>
</div>
