from flask import Flask, json, render_template, request, redirect, jsonify
import sqlite3
import requests

app = Flask(__name__, template_folder='.')

@app.route('/inserir', methods=['GET', 'POST'])
def inserir():
	if request.method == 'POST':
		cpf   = request.values.get('cpf')
		obj = {"documento" : cpf}
		txt = json.dumps(obj)
		resposta = requests.post(url="http://localhost:5002/valida", data=txt)
		txt = resposta.content
		obj = json.loads(txt)
		if obj['status'] == False:
			return 'CPF invalido.'	
	
		cpf   = request.values.get('cpf')
		obj = {"documento" : cpf}
		txt = json.dumps(obj)
		resposta = requests.post(url="http://localhost:5003/validaDiploma", data=txt)
		txt = resposta.content
		obj = json.loads(txt)
		if obj['status'] == False:
			return 'Não concluiu o Ensino Medio.'	

		cpf   = request.values.get('cpf')
		obj = {"documento" : cpf}
		txt = json.dumps(obj)
		resposta = requests.post(url="http://localhost:5003/validaSuperior", data=txt)
		txt = resposta.content
		obj = json.loads(txt)
		if obj['status'] == True:
			return 'Concluiu o Ensino Superior. <script>setTimeout(history.back(), 5000);</script>' 

		nome  = request.values.get('nome')
		curso = request.values.get('curso')
		chave = ''
		insert = "insert into aluno values (null, '" + cpf + "', '" + nome + "', '" + curso + "', '" + chave + "', datetime('now')); "
		conexao = sqlite3.connect('banco.data')
		conexao.execute(insert)
		conexao.commit()
		conexao.close()
		return redirect('/listar')
	elif request.method == 'GET':
		return render_template('cadastro.html')

@app.route('/listar', methods=['GET'])
def listar():
	select = "select id, cpf, nome, curso, ensinomedio, datahora from aluno order by nome; ";
	conexao = sqlite3.connect('banco.data')
	resultado = conexao.execute(select).fetchall()
	conexao.close()
	return render_template("listar.html", resultado=resultado)

@app.route('/remover', methods=['GET'])
def remover() :
	id = request.values.get('id')
	delete = "delete from aluno where id = '" + id + "'; "
	conexao = sqlite3.connect('banco.data')
	conexao.execute(delete)
	conexao.commit()
	conexao.close()
	return redirect("/listar")

@app.route('/', methods=['GET', 'POST'])
def inicio():
	return redirect('/listar')
	
app.run(port=5001, use_reloader=True)
