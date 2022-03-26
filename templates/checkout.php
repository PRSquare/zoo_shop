<style>
	.chechout_form {
		background: #cfcda7;
		padding: 20px 0;
		border-radius: 20px;
		margin-top: 20px;
	}
	.chechout_form h2 {
		text-align: center;
	}
	.chechout_form form {
		margin: 0 auto;
		width: 50%;
	}
	.chechout_form__inside {
		display: grid;
		grid-template-columns: 30% 50%;
	}
	.chechout_form__inside input {
		margin-bottom: 10px;
	}
	.necessary_field {
		color: red;
		margin-right: 2px;
	}
	#send_ch_form {
		width: 20%;
		
		margin-top: 10px;
	}
</style>
<div class="chechout_form">
	<h2>Заполните форму для оформления заказа</h2>
	<form method="POST" action="postCatcher/buy.php">
		<div class="chechout_form__inside">
			<div><span class="necessary_field">*</span><span>Фамилия:</span></div>
			<input required type="text" name="sername" placeholder="Иванов">
			<div><span class="necessary_field">*</span><span>Имя:</span></div>
			<input required type="text" name="name" placeholder="Иван">
			<span>Отчество:</span>
			<input type="text" name="patr" placeholder="Иванович">
			<div><span class="necessary_field">*</span><span>Телефон:</span></div>
			<input required type="tel" name="phone_number" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" placeholder="+7 (***) ***-**-**">
			<span>Email</span>
			<input type="email" name="email" placeholder="email@mail.com">
			<div><span class="necessary_field">*</span><span>Адрес</span></div>
			<input required type="text" name="address" placeholder="г. Москва ул. Тверская д.1">
			<div><span class="necessary_field">*</span><span>Дата доставки</span></div>
			<input required type="date" name="date" value='<?=$curdate?>'>
		</div>
		<span>Итоговая сумма заказа <?=$fin_price?> &#8381</span><br>
		<input id='send_ch_form' type="submit" name="" value="Send">
	</form>
</div>