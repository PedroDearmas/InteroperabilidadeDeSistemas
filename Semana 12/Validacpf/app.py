from flask import Flask, request, json

programa = Flask ( __name__, template_folder='.' )

@programa.route('/valida', methods=['POST'] )
def valida ():
    txt = request.get_data()
    obj = json.loads(txt)
    documento = obj['documento']
    obj = { "status" : True }
    if len(documento) != 11:
        obj = { "status" : False }
    if not documento.isdigit():
        obj = { "status" : False }
    soma = 0
    for i in range(0, 9):
        n = int(documento[i])
        m = 10-i
        soma = soma + (n*m)
    resto = soma%11
    dv = 11-resto
    if dv > 9:
        dv = 0
    if dv != int(documento[9]):
        obj = { "status" : False }
    soma = 0
    for i in range(0, 10):
        n = int(documento[i])
        m = 11-i
        soma = soma + (n*m)
    resto = soma%11
    dv = 11-resto
    if dv > 9:
        dv = 0
    if dv != int(documento[10]):
        obj = { "status" : False }
    txt = json.dumps( obj )
    return txt

programa.run( port=5002, use_reloader=True )