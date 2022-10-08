<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="<?= ($SCHEME.'://'.$HOST.$BASE.($PORT !== 443 || $PORT !== 80 ? ':'.$PORT : '').'/'.$UI) ?>" />
		<meta charset="<?= ($ENCODING) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= ($site) ?></title>
        <!-- <?php if ($menuActivePage=='book'): ?> -->
        <!-- <script src="https://unpkg.com/petite-vue@0.2.2/dist/petite-vue.iife.js"></script> -->
        <!-- <?php endif; ?> -->
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1/dist/tailwind.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@1.10.0/dist/full.css" rel="stylesheet" type="text/css"/>
		<!-- <link rel="stylesheet" href="/css/typography.css" type="text/css" /> -->
		<link rel="stylesheet" href="/btax/css/theme.css" type="text/css" />
        <link rel="stylesheet" href="/btax/css/menu.css" type="text/css" />
        <link rel="stylesheet" href="/btax/css/table.css" type="text/css" />
        <link rel="stylesheet" href="/btax/css/sticky-footer.css" type="text/css" />
	</head>
	<body>
        <div class="container-fluid">
            <div class="row header">
                <div class="header-main col-md-12">
                    <h1><?= ($site) ?></h1>
                </div>
                <div class="col-md-12 menu">
                    <ul>
                        <li class="<?= (($menuActivePage=='home')?'active':'') ?>"><a href="/btax/home">Home</a></li>
                        <li class="<?= (($menuActivePage=='import')?'active':'') ?>"><a href="/btax/import">Import</a></li>
                        <li class="<?= (($menuActivePage=='view')?'active':'') ?>"><a href="/btax/view">View</a></li>
                        <li class="<?= (($menuActivePage=='statement')?'active':'') ?>"><a href="/btax/statement">Statement</a></li>
                        <li class="<?= (($menuActivePage=='account')?'active':'') ?>" style="float:right"><a href="/btax/login">Account</a></li> 
                    </ul>
                </div>
            </div>
            <div class="content row">
                <div class="col-md-12">
                    <div class="col-sm-10">
                        <?php echo $this->render($inc,NULL,get_defined_vars(),0); ?>
                    </div>
                </div>
            </div>
            <div class="push"></div>
        </div>
        <footer class="footer">
            <div class="container">
                <p>Copyright © 2022 <?= ($site) ?></p>
            </div>
        </footer>
	</body>
</html>


