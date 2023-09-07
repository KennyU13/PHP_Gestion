
<script>

function deleteEntre(x) 
{
   
    if(confirm('Êtes-vous sûr de vouloir supprimer la ligne '+ x +' ?'))
    {
        
        $("#supprimer").attr("href", "?page=entre&identre="+x);
        alert('Donnée supprimer !');
    }
    else
    {
        $("#supprimer").attr("href", "?page=entre");
    }
    
}
function deleteSortie(x) {
    if(confirm('Êtes-vous sûr de vouloir supprimer la ligne '+ x +' ?'))
    {
        
        $("#supprimer").attr("href", "?page=sortie&idsortie="+x);
        alert('Donnée supprimer !');
    }
    else
    {
        $("#supprimer").attr("href", "?page=sortie");
    }
}
// function showDanger()
// {
    
//     var x = document.getElementById('ideglise');
//     var y = document.getElementById('designEglise');
    
//     if(x.value == "" && y.value =="")
//     {
//         $("#ideglise").addClass("is-invalid");
       
   
//     }
   
   
   
// }
</script>

</body>

</html>