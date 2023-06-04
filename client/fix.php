
<?php
require "../PHP/Start.php";
?>
<div class="container">
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cartModal">
    View Cart
  </button>  
</div>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">
            Carrinho de compras
        </h5>
        <a id="btnEmpty" href="client-index-mesa1.php?action=empty">Esvaziar carrinho</a>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
        if (isset($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
        ?>
        <table class="table table-image">
          <thead>
            <tr>
              <th scope="col">Imagem</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Qty</th>
              <th scope="col">Total</th>
              <th scope="col">Actions</th>
            </tr>
            <?php
                foreach ($_SESSION["cart_item"] as $item) {
                    $item_price = $item["quantity"] * $item["price"];
                ?>
          </thead>
          <tbody>
            <tr>
              <td class="w-25">
                <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" class="img-fluid img-thumbnail" alt="Sheep">
              </td>
              <td><img src="<?php echo $item["image"] ?>" alt=""></td>
              <td><?php echo $item["name"] ?></td>
              <td><?php echo "R$ " . $item["price"]; ?></td>
              <td class="qty"><?php echo $item["quantity"]; ?></td>
              <td>178$</td>
              <td>
                <a href="#" class="btn btn-danger btn-sm">
                  <i class="fa fa-times"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table> 
        <?php
            $total_quantity += $item["quantity"];
            $total_price += ($item["price"] * $item["quantity"]);
        }
        ?>
        <div class="d-flex justify-content-end">
          <h5>Total: R$<span class="price text-success"><?php echo $total_quantity; ?></span></h5>
        </div>
      </div>
      <div class="modal-footer border-top-0 d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success">Finalizar Compra</button>
      </div>
      <?php
        } else {
        ?>
            <div class="no-records">Seu carrinho está vazio.</div>
        <?php
        }
        ?>
    </div>
  </div>
</div>

<style>
    .container {
  padding: 2rem 0rem;
}

.table-image td{
    vertical-align: middle;
    text-align: center;
    border: 0;
    color: #666;
    font-size: 0.8rem;
}

.table-image qty{
      max-width: 2rem;
}

.price {
  margin-left: 1rem;
}

.modal-footer {
  padding-top: 0rem;
}
</style>


<div class='modal fade' id='verCarrinho' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-xl modal-dialog-scrollable'>
        <div class="modal-content">
            <div id="shopping-cart">
                <div class="modal-header">Carrinho de compras
                    <a id="btnEmpty" href="client-index-mesa1.php?action=empty">Esvaziar carrinho</a>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($_SESSION["cart_item"])) {
                        $total_quantity = 0;
                        $total_price = 0;
                    ?>
                    
                        <table class="tbl-cart" cellpadding="10" cellspacing="1">
                            <tbody>
                                <tr>
                                    <th style="text-align:left;">Nome</th>
                                    <th style="text-align:right;" width="5%">Quantidade</th>
                                    <th style="text-align:right;" width="10%">Preço</th>
                                    <th style="text-align:center;" width="5%">Remove</th>
                                </tr>
                                <?php
                                foreach ($_SESSION["cart_item"] as $item) {
                                    $item_price = $item["quantity"] * $item["price"];
                                ?>
                                    <tr>
                                        <td><?php echo $item["name"]; ?></td>
                                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                        <td style="text-align:right;"><?php echo "R$ " . $item["price"]; ?></td>
                                        <td style="text-align:center;"><a href="client-index-mesa1.php?action=remove&code=<?php echo $item["id"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                    </tr>
                                <?php
                                    $total_quantity += $item["quantity"];
                                    $total_price += ($item["price"] * $item["quantity"]);
                                }
                                ?>
                                <div class="modal-footer">
                                    <td colspan="2" align="right">Total:</td>
                                    <td align="right"><?php echo $total_quantity; ?></td>
                                    <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                                    <td></td>
                                    </div>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <div class="no-records">Seu carrinho está vazio.</div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>