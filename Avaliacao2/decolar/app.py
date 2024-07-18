from flask import Flask, json, render_template, request, redirect, jsonify
import sqlite3
import requests

app = Flask(__name__, template_folder='.')

@app.route('/listar', methods=['GET', 'POST'])
def listar ():
	if request.method == 'POST':
		origem   = request.values.get('origem')
		destino   = request.values.get('destino')
		data   = request.values.get('data')
		objbusca = {"origem" : origem, "destino" : destino, "data" : data}

		txt = json.dumps(objbusca)
		resposta = requests.post(url="http://localhost:8081/servicogol.php", data=txt)
		txt = resposta.content
		objgol = json.loads(txt)

		txt = json.dumps(objbusca)
		resposta = requests.post(url="http://localhost:8082/servicolatam.php", data=txt)
		txt = resposta.content
		objlatam = json.loads(txt)
		return render_template('listar.html', objgol = objgol, objlatam = objlatam)
	
	elif request.method == 'GET':
		return render_template('listar.html')
	

@app.route('/comprar', methods=['GET'])
def comprar ():
	id = request.values.get('id')
	voo = request.values.get('voo')
	return render_template('comprar.html',res={'id':id,'voo':voo})

@app.route('/confirmar', methods=['GET', 'POST'])
def confirmar():
	if request.method == 'POST':
		id   = request.values.get('id')
		voo   = request.values.get('voo')
		cpf   = request.values.get('cpf')
		nome   = request.values.get('nome')

		if "LATAM" in voo:
			url = "http://localhost:8082/servicocomplatam.php"
		else:
			url = "http://localhost:8081/servicocompgol.php"
		txt = json.dumps({"id":id,"cpf":cpf,"nome":nome}) 
		resp = requests.post(url=url,data=txt)
		txt = resp.content
		result = json.loads(txt)
		return render_template('confirmar.html',result=result)

	return render_template('confirmar.html')

@app.route('/', methods=['GET', 'POST'])
def index():
	return redirect('/listar')
	
app.run(port=5001, use_reloader=True)
