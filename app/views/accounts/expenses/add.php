<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Mobile header with Nav bar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with nav bar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktop header with nav bar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6" style="margin:auto ">
                        <div class="x_panel au-card au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="au-card-title"
                                         style="background-image:url('<?php echo URLROOT ?>/images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="fa fa-pencil-alt"></i>Add Expense</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php URLROOT; ?>/accounts/expenses/add"
                                              method="post" id="register-form">
                                            <div class="form-group">
                                                <div class="input-group-addon2">Expense Type</div>
                                                <div class="input-group">
                                                    <select id="expense_type_id" name="expense_type_id"
                                                            class="form-control">
                                                        <option value="" selected="selected">Select Expense Type
                                                        </option>
														<?php foreach ( $data['expense_types'] as $expense_type ): ?>
                                                            <option value="<?php echo $expense_type->id; ?>"> <?php echo $expense_type->expense_type_name; ?></option>
														<?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Amount</div>
                                                <div class="input-group">
                                                    <input type="text" id="amount" name="amount"
                                                           class="form-control" placeholder="Enter amount" required>
                                                    <input type="hidden" id="outstanding" name="outstanding" required
                                                           value="<?php echo $data['outstanding']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Note</div>
                                                <div class="input-group">
                                                    <input type="text" id="note" name="note"
                                                           class="form-control" placeholder="Enter a note" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Date</div>
                                                <div class="input-group">
                                                    <input type="text" id="date" name="date" placeholder="Insert Date"
                                                           class="form-control datepicker" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-primary">Add Expense</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                todayHighlight: true,
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $(function () {
                var maxValue = parseFloat($('#outstanding').val());

                $.validator.setDefaults({
                    errorClass: 'help-block',
                    highlight: function (element) {
                        $(element)
                            .closest('.form-group')
                            .addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element)
                            .closest('.form-group')
                            .removeClass('has-error');
                    },
                    errorPlacement: function (error, element) {
                        if (element.prop('type') === 'checkbox') {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
                $("#register-form").validate({
                    rules: {
                        expense_type_id: {
                            required: true
                        },
                        amount: {
                            required: true,
                            pattern: /^[0-9]+(?:\.[0-9]{1,5})?$/,
                            max: maxValue
                        },
                        note: {
                            required: true,
                            minlength: 5
                        },
                        date: {
                            required: true
                        }
                    },
                    messages: {
                        expense_type_id: {
                            required: 'Please select a type of expense name'
                        },
                        amount: {
                            required: 'Please enter an amount',
                            pattern: 'Please enter a valid amount',
                            max: 'That much cash is not in hand'
                        },
                        note: {
                            required: 'Please enter Contact Number',
                            minlength: 'note must have minimum 5 characters'
                        },
                        date: {
                            required: 'Please insert a date'
                        }
                    }
                });
            });
        });
    </script>

<?php require APPROOT . '/views/layouts/footer.php' ?>