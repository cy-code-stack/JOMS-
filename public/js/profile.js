$(document).ready(function() {
    $('.edit-button').click(function() {
        console.log('s');
      var container = $(this).closest('.main-profile-container');
      var inputs = container.find('.editable');
      var inputsDisable = container.find('.editable');
      var saveButton = container.find('.save-button');
      var cancelButton = container.find('.cancel-button');
  
      // Enable the inputs
      inputs.prop('disabled', false);
      inputsDisable.removeClass('disable');

  
  
      // Show the Save and Cancel buttons
      saveButton.show();
      cancelButton.show();
  
      // Hide the Edit button
      $(this).hide();
    });
  
    $('.cancel-button').click(function() {
      var container = $(this).closest('.main-profile-container');
      var inputs = container.find('input');
      var inputsDisable = container.find('.editable');
      var editButton = container.find('.edit-button');
      var saveButton = container.find('.save-button');
  
      // Disable the inputs
      inputs.prop('disabled', true);
      inputsDisable.addClass('disable');
      // Show the Edit button
      editButton.show();
  
      // Hide the Save and Cancel buttons
      saveButton.hide();
      $(this).hide();
    });
  
    $('.save-button').click(function() {
      var container = $(this).closest('.main-profile-container');
      var inputs = container.find('input');
      var editButton = container.find('.edit-button');
      var cancelButton = container.find('.cancel-button');
      var form = container.find('form')
  
      
      form.submit()
  
    //   // Disable the inputs
    //   inputs.prop('disabled', true);
  
    //   // Show the Edit button
    //   editButton.show();
  
    //   // Hide the Save and Cancel buttons
    //   $(this).hide();
    //   cancelButton.hide();
    });
  });
  