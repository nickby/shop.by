<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2016</p>
                <p class="pull-right">Пример по курсу PHP Start</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>

<!-- AJAX -->
<script>
    $(document).ready(
        // код будет выполнен после загрузки документа
        function () {
            // срабатывание по нажатию кнопки с именем "add-to-cart" - "В корзину"
            $(".add-to-cart").click(
                function () {
                    // из свойства кнопки "data-id" читаем id товара
                    var id = $(this).attr("data-id");
                    // асинхронный запрос методом POST
                    $.post(
                            "/cart/addAjax/" + id,  // адрес, на который отправляем запрос
                            {},                     // параметры запроса - в данном случае не нужны
                            // ответ приходит в data, проставляем его в счетчик корзины (cart-count)
                            function (data) { $("#cart-count").html(data); }
                    );
                    return false;
                }
            );
        }
    );
</script>

</body>
</html>
