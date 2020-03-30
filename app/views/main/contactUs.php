<div class="clearfix mt-2">
    <h1 class="float-left h3">Contact Us</h1>
    <div class="float-right">
        <form action="search" method="get" autocomplete="off">
            <div class="input-group">
                <input class="form-control round" type="search" name="q" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary round" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="mt-2">
    <?php getReport(); ?>
</div>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card mx-auto mt-md-5">
            <div class="card-body">
                <h4 class="card-title mb-5">Ask a Question</h4>
                <form method="post" class="form-input needs-validation" novalidate>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" value="<?=isset($_SESSION['form-data']['email']) ? html($_SESSION['form-data']['email']) : null;?>" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="question" cols="30" rows="10" placeholder="Your Question" required><?=isset($_SESSION['form-data']['question']) ? html($_SESSION['form-data']['question']) : null;?></textarea>
                    </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block mt-4">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>