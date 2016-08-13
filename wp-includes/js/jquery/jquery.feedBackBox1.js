/*
	Copyright (c) 2013 
	Willmer, Jens (http://jwillmer.de)	
	
	Permission is hereby granted, free of charge, to any person obtaining
	a copy of this software and associated documentation files (the
	"Software"), to deal in the Software without restriction, including
	without limitation the rights to use, copy, modify, merge, publish,
	distribute, sublicense, and/or sell copies of the Software, and to
	permit persons to whom the Software is furnished to do so, subject to
	the following conditions:
	
	The above copyright notice and this permission notice shall be
	included in all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	
	
	feedBackBox: A small feedback box realized as jQuery Plugin.
	@author: Willmer, Jens
	@url: https://github.com/jwillmer/feedBackBox
	@documentation: https://github.com/jwillmer/feedBackBox/wiki
	@version: 0.0.1
*/
; (function ($) {
    $.fn.extend({
        feedBackBox: function (options) {

            // default options
            this.defaultOptions = {
                title: 'Order',
                titleMessage: 'Your Order',
                userName: '',
                isUsernameEnabled: true,
                message: '',
                ajaxUrl: 'http://..',
                successMessage: 'Thank your for your feedback.',
                errorMessage: 'Something went wrong!'
            };

            var settings = $.extend(true, {}, this.defaultOptions, options);

            return this.each(function () {
                var $this = $(this);
                var thisSettings = $.extend({}, settings);

                var diableUsername;
                if (!thisSettings.isUsernameEnabled) {
                    diableUsername = 'disabled="disabled"';
                }

                // add feedback box
                $this.html('<div id="fpi_feedback"><div id="fpi_content"><div id="fpi_header_message"><strong>'
                    + thisSettings.titleMessage
                    + '</strong></div><div class="order-place"><p>There are no items in your order.</p><div class="rule" style="margin:0"></div><div class="sub"><p>Subtotal</p><p>Delivery</p></div><div class="price"><p>$ 0.00</p><p>$0.00</p></div><div class="rule" style="margin:0"></div><div class="tot">Total</div><div class="amt"> $ 0.00	</div><div class="rule" style="margin:0"></div><a style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:14px; margin-left:60px; border-radius:3px;  padding: 0 9px 4px; margin-top:10px;" class="sc-button light " href="">Proceed to checkout</a><div class="min-ord">The minimum order for Rudraksha is $35 excluding delivery</div></div></div></div>');
                   

                // remove error indication on text change
                $('#fpi_submit_username input').change(function () {
                    if ($(this).val() != '') {
                        $(this).removeClass('error');
                    }
                });
                $('#fpi_submit_message textarea').change(function () {
                    if ($(this).val() != '') {
                        $(this).removeClass('error');
                    }
                });

                // submit action
                $this.find('form').submit(function () {

                    // validate input fields
                    var haveErrors = false;
                    if ($('#fpi_submit_username input').val() == '' && typeof diableUsername == 'undefined') {
                        haveErrors = true;
                        $('#fpi_submit_username input').addClass('error');
                    }
                    if ($('#fpi_submit_message textarea').val() == '') {
                        haveErrors = true;
                        $('#fpi_submit_message textarea').addClass('error');
                    } 

                    // send ajax call
                    if (!haveErrors) {
                        // serialize all input fields
                        var disabled = $(this).find(':input:disabled').removeAttr('disabled');
                        var serialized = $(this).serialize();
                        disabled.attr('disabled', 'disabled');

                        // disable submit button
                        $('#fpi_submit_submit input').attr('disabled', 'disabled');

                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: thisSettings.ajaxUrl,
                            data: serialized,
                            beforeSend: function () {
                                $('#fpi_submit_loading').show();
                            },
                            error: function (data) {
                                $('#fpi_content form').hide();
                                $('#fpi_content #fpi_ajax_message h2').html(thisSettings.errorMessage);
                            },
                            success: function () {
                                $('#fpi_content form').hide();
                                $('#fpi_content #fpi_ajax_message h2').html(thisSettings.successMessage);
                            }
                        });
                    }

                    return false;
                });

                // open and close animation
                var isOpen = true;
                $('#fpi_title').click(function () {});

            });
        }
    });
})(jQuery);
