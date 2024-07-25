
<style>
@page { margin: 180px 50px; }
 #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; }
 #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px;}
 #footer .page:after { content: counter(page, upper-roman); }
</style>
        
<div id="header">
<img src="uploads/header.png"   alt="Header Image" style="width: 100%;">
</div>
<div id="footer">
<img src="uploads/footer.png"   alt="Header Image" style="width: 100%;">
</div>
<div id="content">

<h4> Programme And Batch: <?php echo $class_name, $section_name ?></h4>
<h4> Month And Year: <?php echo "$month_name $year" ?></h4>
</div>
