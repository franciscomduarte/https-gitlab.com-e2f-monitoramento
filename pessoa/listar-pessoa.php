<div class="row row-offcanvas row-offcanvas-right">    
    <div class="row">
        <div class="table-responsive">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"></button>
                                <a class="navbar-brand" href="#">Novo Registro</a>
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>C&oacute;digo</th>
                        <th>Nome</th>
                        <th>Celular</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                    require_once 'conexao/conn.php';

                    $sql = "select * from pessoa";
                    $rs = mysqli_query($conexao, $sql);
                    $num = 0;

                    while ($linha = mysqli_fetch_array($rs)) {
                        $num++;
                        ?>
                        <tr>
                            <td><?php echo $num ?></td>
                            <td><?php echo $linha['id'] ?></td>
                            <td><?php echo $linha['nome'] ?></td>
                            <td><?php echo $linha['celular'] ?></td>
                            <td><?php echo $linha['telefone'] ?></td>
                            <td><?php echo $linha['email'] ?></td>

                        </tr>

                        <?php
                    }
                    ?>  			            
                </tbody>
            </table>   
        </div>                   
    </div>
</div>
<div class="col-md-12 text-center">
    <ul class="pagination" id="myPager"></ul>
</div>