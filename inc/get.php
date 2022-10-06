<form method="post" action="/#section6">
  <label for="name">Nome:</label> <br>
  <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>" required ><br>
  <label for="comment">Deixe um comentário:</label>
  <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
  <label for="choice">Você acha que o bebê é:</label><br>
  <div class="row">
    <div class="col-sm-6 section-body">
      <input type="submit" class="btn enquete-btn-1" name="gender" value="Severino" onclick=window.location = "#section6";> </input>
    </div>
    <div class="col-sm-6 section-body">
      <input type="submit" class="btn enquete-btn-2" name="gender" value="Severina" onclick=window.location = "#section6";> </input>
    </div>
  </div>
</form>