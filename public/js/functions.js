function clearOut(parent,elements){
   elements.forEach(element=>{
      $(parent).find("input[name='"+ element +"']").val('')
   })
}