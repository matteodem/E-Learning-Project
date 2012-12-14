$(document).ready(function(){
  /* Keeping all the Infos of the deleted / reverted cards */
  var flashcardCache = new Array();
  
  function getRevertedCardHtml(field, cache) {
      for (i = 0; i < cache.length; i++) {
          if (cache[i].field === field) {
              var revertedCardHtml = cache[i].html;
              flashcardCache = removeFromArray(cache[i].field, cache);
              return revertedCardHtml;
          }
      }
  }
  
  function removeFromArray(content, array) {
    for (i = 0; i < array.length; i++) {
        if (content === array[i].field)
            array.splice(i, 1);
    }
    return array;
  }
  
  function getNewAttribute(attribute) {
      if (attribute) {
          var currentNumber = attribute.match('[0-9]+');
          var newAttribute = attribute.replace(currentNumber, parseFloat(currentNumber) + 1);
      } else {
          newAttribute = "";
      }
      
      return newAttribute;
  }
  
  function addNewRow(thisObj) {
      var emptyRow = $('#hiddenCardRow').html();

      $('.newCardRow').before('<tr class="newcardRow cardRow">' + emptyRow + '</tr>');
      $('.newCardRow').last().children().children().each(function() { 
          var oldId = $(thisObj).attr('id');
          var oldName = $(thisObj).attr('name');
          
          $(thisObj).attr('id', getNewAttribute(oldId));
          $(thisObj).attr('name', getNewAttribute(oldName));
      });
      $('tr.cardRow:last input.front').focus();
  }
  
  /* Keeping track of the flashcard values */
  $('input').live('keyup', function(){
      $(this).attr('value', $(this).val());
  });
  
  $('textarea').live('keyup', function(){
      $(this).html($(this).first().val());
  });
  
  /* Delete a Flashcard Icon */
  $('.deleteFlashcard').live("click", function(e) {
      var tableRow = $(this).parent().parent();
      flashcardCache.push({ field: tableRow.find('input').attr('id'), html: tableRow.html()});
      
      var revertButton = '<td colspan="4"> \
                            <a href="#" class="revertFlashcard" id="' + tableRow.find('input').attr('id') +'"><i class="icon-repeat"></i></a> \
                          </td>';
                          
      if (tableRow.is('tr')) {
          tableRow.html(revertButton);
      }
      e.preventDefault();
  });
  
  /* Append a click event for reverting the flashcard */
  $('.revertFlashcard').live("click", function(e) {
      var html = getRevertedCardHtml($(this).attr('id'), flashcardCache);
      var thisRow = $(this).parent().parent();
      thisRow.html(html);
      e.preventDefault();
  });
  
  // The add a new flashcard button
  $('.createNewFlashcard').live("click", function(e){
      addNewRow(this);
      e.preventDefault();
  });
  
  // Tabbing new flashcard rows (faster writing)
  $('tr.cardRow:last textarea.flashTextarea').live("keydown", function(e) {
      var code = e.keyCode || e.which;
      if (9 === code) {
          addNewRow(this);
          e.preventDefault();
      }
  });
  
  /* When submitting the form */
  $('#editCardsButton').click(function(e) { $('#hiddenCardRow').remove(); });
  $('#addFlashcardsForm').submit(function(e) { $('#hiddenCardRow').remove(); });
});