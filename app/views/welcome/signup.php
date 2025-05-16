<h2>Minha Rede Social</h2>
<h1>Boas vindas!</h1>
<p>Cadastre-se e participe desta experiência!</p>

<form method="POST" action="<?php Routes::path('welcome/signup') ?>">
	<div>
		<label>Email</label><br>
		<input type="text" name="email" required>
	</div>
	<div>
		<label>Senha</label><br>
		<input type="password" name="password" required>
	</div>
	<div>
		<button>Cadastrar</button>
	</div>
</form>
