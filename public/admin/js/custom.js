$(document).ready(function() {



  /*** Open Editing User Modal ***/
  $('.editUserBtn').on('click', function () {
    var userID = $(this).data('userid');
    $.ajax({
      type: 'get',
      url: url + '/admin/users/' + userID + '/edit',
      success: function (data) {
        $('.requestUserData').html(data);
        $('.editUserModal').modal('toggle');
      }
    });
  });

  /*** Open Deleting User Modal***/
  $('.userDelete').on('click', function () {
    var userID = $(this).data('userid');
    $('.deleteUserModal').modal('toggle');
    $('.deleteUserBtn').val(userID);
  });

  /*** Deleting User ***/
  $('.deleteUserBtn').on('click', function () {
    var userID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/users/' + userID,
      data: {id: userID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + userID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteUserModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('User not found or Something is going wrong');
        $('.deleteUserModal').modal('hide');
      }
    });
  });

  /*** Open Editing Category Modal ***/
  $('.editCatBtn').on('click', function () {
    var catID = $(this).data('catid');
    $.ajax({
      type: 'get',
      url: url + '/admin/categories/' + catID + '/edit',
      success: function (data) {
        $('.requestCatData').html(data);
        $('.editCatModal').modal('toggle');
      }
    });
  });

  /*** Open Deleting Category Modal ***/
  $('.catDelete').on('click', function () {
    var catID = $(this).data('catid');
    $('.deleteCatModal').modal('toggle');
    $('.deleteCatBtn').val(catID);
  });

  /*** Deleting Category ***/
  $('.deleteCatBtn').on('click', function () {
    var categoryID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/categories/' + categoryID,
      data: {id: categoryID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + categoryID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteCatModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Category not found or Something is wrong');
        $('.deleteCatModal').modal('hide');
      }
    });
  });

  /*** Open Deleting Product Modal ***/
  $('.productDelete').on('click', function () {
    var productID = $(this).data('productid');
    $('.deleteProductModal').modal('toggle');
    $('.deleteProductBtn').val(productID);
  });

  /*** Deleting Product ***/
  $('.deleteProductBtn').on('click', function () {
    var productID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/products/' + productID,
      data: {id: productID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + productID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteProductModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Product not found or Something is wrong');
        $('.deleteProductModal').modal('hide');
      }
    });
  });

  /*** Open Editing Voucher Modal ***/
  $('.editVoucherBtn').on('click', function () {
    var voucherID = $(this).data('voucherid');
    $.ajax({
      type: 'get',
      url: url + '/admin/vouchers/' + voucherID + '/edit',
      success: function (data) {
        $('.requestVoucherData').html(data);
        $('.editVoucherModal').modal('toggle');
      }
    });
  });

  /*** Open Deleting Voucher Modal ***/
  $('.voucherDelete').on('click', function () {
    var voucherID = $(this).data('voucherid');
    $('.deleteVoucherModal').modal('toggle');
    $('.deleteVoucherBtn').val(voucherID);
  });

  /*** Deleting Voucher ***/
  $('.deleteVoucherBtn').on('click', function () {
    var voucherID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/vouchers/' + voucherID,
      data: {id: voucherID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + voucherID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteVoucherModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Voucher not found or Something is wrong');
        $('.deleteVoucherModal').modal('hide');
      }
    });
  });

  /*** Open Editing Modifier Modal ***/
  $('.editmodifiergroupBtn').on('click', function () {
    var modifiergroupID = $(this).data('modifiergroupid');
    $.ajax({
      type: 'get',
      url: url + '/admin/modifiers/' + modifiergroupID + '/edit',
      success: function (data) {
        $('.requestmodifiergroupData').html(data);
        $('.editmodifiergroupModal').modal('toggle');
        $('.searchableSelectBoxMultiple').select2();
      }
    });
  });

  /*** Open Deleting Modifier Group Modal ***/
  $('.modifiergroupDelete').on('click', function () {
    var modifiergroupID = $(this).data('modifiergroupid');
    $('.deletemodifiergroupModal').modal('toggle');
    $('.deletemodifiergroupBtn').val(modifiergroupID);
  });

  /*** Deleting Modifier Group ***/
  $('.deletemodifiergroupBtn').on('click', function () {
    var modifiergroupID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/modifiers/' + modifiergroupID,
      data: {id: modifiergroupID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + modifiergroupID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deletemodifiergroupModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Modifier Group not found or Something is wrong');
        $('.deletemodifiergroupModal').modal('hide');
      }
    });
  });

  /*** Open Editing Group Modal ***/
  $('.editGroupBtn').on('click', function () {
    var groupID = $(this).data('groupid');
    $.ajax({
      type: 'get',
      url: url + '/admin/groups/' + groupID + '/edit',
      success: function (data) {
        $('.requestGroupData').html(data);
        $('.editGroupModal').modal('toggle');
      }
    });
  });

  /*** Open Deleting Group Modal ***/
  $('.groupDelete').on('click', function () {
    var groupID = $(this).data('groupid');

    $('.deleteGroupModal').modal('toggle');
    $('.deleteGroupBtn').val(groupID);
  });

  /*** Deleting Group ***/
  $('.deleteGroupBtn').on('click', function () {
    var groupID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/groups/' + groupID,
      data: {id: groupID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + groupID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteGroupModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Group not found or Something is wrong');
        $('.deleteGroupModal').modal('hide');
      }
    });
  });

  /*** Open Editing Taxes Group Modal ***/
  $('.editTaxBtn').on('click', function () {
    var taxID = $(this).data('taxid');
    $.ajax({
      type: 'get',
      url: url + '/admin/taxes/' + taxID + '/edit',
      success: function (data) {
        $('.requestTaxData').html(data);
        $('.editTaxModal').modal('toggle');
      }
    });
  });

  /*** Open Deleting Tax Group Modal ***/
  $('.taxDelete').on('click', function () {
    var taxID = $(this).data('taxid');

    $('.deleteTaxModal').modal('toggle');
    $('.deleteTaxBtn').val(taxID);
  });

  /*** Deleting Tax Group ***/
  $('.deleteTaxBtn').on('click', function () {
    var taxID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/taxes/' + taxID,
      data: {id: taxID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + taxID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteTaxModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Tax Group not found or Something is wrong');
        $('.deleteTaxModal').modal('hide');
      }
    });
  });

  /*** Open Editing Zipgroup Modal ***/

  $('.editZipgroupBtn').on('click', function () {
    var ZipgroupID = $(this).attr('data-zipgroupid');
    $.ajax({
      type: 'get',
      url: url + '/admin/zipgroups/' + ZipgroupID + '/edit',
      success: function (data) {
        $('.requestZipgroupData').html(data);
        $('.editZipgroupModal').modal('toggle');
      }
    });
  });


/*** Open Deleting zipGroup Modal ***/
  
  $('.zipgroupDelete').on('click',function(){
    var zipgroupID = $(this).attr('data-zipgroupid');
    $('.deleteZipgroupModal').modal('toggle');
    $('.deleteZipgroupBtn').val(zipgroupID);
  });

/*** Deleting Tax Group ***/  
  $('.deleteZipgroupBtn').on('click',function(){
    var zipgroupID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/zipgroups/' + zipgroupID,
      data: { id: zipgroupID, _token: token, _method: 'DELETE' },
      success: function (data) {
        $('#target_' + zipgroupID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteZipgroupModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Zipgroup not found or Something is wrong');
        $('.deleteZipgroupModal').modal('hide');
      }
    });
  });



  /*** Open Editing Zipcode Modal ***/
  $('.editZipcodeBtn').on('click', function () {
    var zipcodeID = $(this).data('zipcodeid');
    $.ajax({
      type: 'get',
      url: url + '/admin/zipcodes/' + zipcodeID + '/edit',
      success: function (data) {
        $('.requestZipcodeData').html(data);
        $('.editZipcodeModal').modal('toggle');
      }
    });
  });

  /*** Open Deleting Zipcode Modal ***/
  $('.zipcodeDelete').on('click', function () {
    var zipcodeID = $(this).data('zipcodeid');

    $('.deleteZipcodeModal').modal('toggle');
    $('.deleteZipcodeBtn').val(zipcodeID);
  });

  /*** Deleting Zipcode ***/
  $('.deleteZipcodeBtn').on('click', function () {
    var zipcodeID = $(this).val();
    $.ajax({
      type: 'post',
      url: url + '/admin/zipcodes/' + zipcodeID,
      data: {id: zipcodeID, _token: token, _method: 'DELETE'},
      success: function (data) {
        $('#target_' + zipcodeID).hide();
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-danger hide");
        $('#messageDiv').addClass("alert-success");
        $('#message').html(data);
        $('.deleteZipcodeModal').modal('hide');
      },
      error: function () {
        $('#success_errror_any').addClass("hide");
        $('#messageDiv').removeClass("alert-success hide");
        $('#messageDiv').addClass("alert-danger");
        $('#message').html('Zipcode not found or Something is wrong');
        $('.deleteZipcodeModal').modal('hide');
      }
    });
  });

    $('#customSwitch0').click(function () {
      if ($(this).prop("checked")) {
        $('#hiddenfield0').val('1');
      } else {
        $('#hiddenfield0').val('0');
      }
    });

    $('#customSwitch1').click(function () {
      if ($(this).prop("checked")) {
        $('#hiddenfield1').val('1');
      } else {
        $('#hiddenfield1').val('0');
      }
    });

    $('#customSwitch2').click(function () {
      if ($(this).prop("checked")) {
        $('#hiddenfield2').val('1');
      } else {
        $('#hiddenfield2').val('0');
      }
    });

    $('#customSwitch3').click(function () {
      if ($(this).prop("checked")) {
        $('#hiddenfield3').val('1');
      } else {
        $('#hiddenfield3').val('0');
      }
    });

    $('#socials_reglog_switch').click(function () {
      if ($(this).prop("checked")) {
        $('#socials_reglog_hidden').val('1');
        $('#socials_account_div').removeClass('hide');
      } else {
        $('#socials_reglog_hidden').val('0');
        $('#socials_account_div').addClass('hide');
      }
    });

    var socials_reglog_hidden_val = $('#socials_reglog_hidden').val();
    if (socials_reglog_hidden_val == "1") {
      $('#socials_account_div').removeClass('hide');
    }

    $('#google_reglog_switch').click(function () {
      if ($(this).prop("checked")) {
        $('#google_reglog_hidden').val('1');
        $('#google_account_div').removeClass('hide');
      } else {
        $('#google_reglog_hidden').val('0');
        $('#google_account_div').addClass('hide');
      }
    });

    var google_reglog_hidden_val = $('#google_reglog_hidden').val();
    if (google_reglog_hidden_val == "1") {
      $('#google_account_div').removeClass('hide');
    }

    $('#facebook_reglog_switch').click(function () {
      if ($(this).prop("checked")) {
        $('#facebook_reglog_hidden').val('1');
        $('#facebook_account_div').removeClass('hide');
      } else {
        $('#facebook_reglog_hidden').val('0');
        $('#facebook_account_div').addClass('hide');
      }
    });

    var facebook_reglog_hidden_val = $('#facebook_reglog_hidden').val();
    if (facebook_reglog_hidden_val == "1") {
      $('#facebook_account_div').removeClass('hide');
    }

    $('#twitter_reglog_switch').click(function () {
      if ($(this).prop("checked")) {
        $('#twitter_reglog_hidden').val('1');
        $('#twitter_account_div').removeClass('hide');
      } else {
        $('#twitter_reglog_hidden').val('0');
        $('#twitter_account_div').addClass('hide');
      }
    });

    var twitter_reglog_hidden_val = $('#twitter_reglog_hidden').val();
    if (twitter_reglog_hidden_val == "1") {
      $('#twitter_account_div').removeClass('hide');
    }

  });
// End document ready function here
