
<script src="assets/js/chart.js/Chart.min.js"></script>
<script> 
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#484954';
    var x =<?=$sommeE?>, y=<?=$sommeS?>;
</script>
<script src="assets/js/demo/defaultPie.js"></script>

<?php if(isset($date1)):?>
<script> var z = <?=$sommeEntre?>,w =<?=$sommeSortie?> ;</script>  
<script src="assets/js/demo/secondPie.js"></script>
<?php endif?>
<script >






