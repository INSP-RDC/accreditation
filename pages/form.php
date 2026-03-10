<?php 
$instance=$cn->query("select * from v_instance where id=$id")->fetch();
$user=$cn->query("select * from v_user where id={$_SESSION['user-id']}")->fetch();
$step ??=1;
$title="Demande d'accréditation"
?>
<style>
    .card-header .card-title{text-transform: uppercase;}
</style>
<div class="row">
    <div class="col-md-8" data-aos="fade-up" data-aos-delay="200">
        <form action="engine/form/submit" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="zones" id="zones" value="[]">
            <input type="hidden" name="rh" id="rh" value="[]">
            <input type="hidden" name="rm" id="rm" value="[]">
            <?php 
            require_once "form.step-1.php";
            require_once "form.step-2.php";
            require_once "form.step-3.php";
            require_once "form.step-4.php";
            ?>
            <div class="row my-4">
                <div class="col-4"><a href="#" onclick="prevBox()" id="prev" class="btn btn-link btn-lg text-warning d-none"><span class="fa fa-angle-left"></span> Précédent</a></div>
                <div class="col-4 text-center">
                    <button type="button" onclick="nextBox()" id="next"  class="btn btn-lg btn-success">Suivant</button>
                    <button type="submit" id="submit"  class="btn btn-lg btn-success d-none">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
    <?php require 'form.sidebar.php'?>
</div>
<script>
    document.querySelectorAll('.autre').forEach(e=>{
        e.addEventListener('click',()=>{
            const target=e.dataset.target
            document.getElementById(target).classList.toggle('d-none')
        })
    })

    let box=0
    const boxes=['step-1','step-2','step-3','step-4']
    function nextBox(){
        document.getElementById(boxes[box]).classList.toggle('d-none')
        box++
        document.getElementById(boxes[box]).classList.toggle('d-none')
        if(box==1){document.querySelector('#prev').classList.remove('d-none')}
        if(box==3){
            document.querySelector('#next').classList.add('d-none')
            document.querySelector('#submit').classList.remove('d-none')
        }
    }
    function prevBox(){
        document.getElementById(boxes[box]).classList.toggle('d-none')
        box--
        document.getElementById(boxes[box]).classList.toggle('d-none')
        if(box==0){document.querySelector('#prev').classList.add('d-none')}
        if(box==2){
            document.querySelector('#next').classList.remove('d-none')
            document.querySelector('#submit').classList.add('d-none')
        }
    }
</script>