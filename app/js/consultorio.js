/**
 *Consultório
 *@autor - Rafael Orlando Mendes
 *@email - rafaorlando3@gmail.com 
 */

// Definindo projeto consultorio
var consultorio = consultorio || {};

// Definindo o módulo no objeto global.
consultorio.moduloT = (function() {
  'use strict';

  function iniciar() {
    listaPacientes();
    listaPacientesConsulta();
    cadastraPaciente();
  }

  function cadastraPaciente() {
    $('#cadastrarPac').click(function () {
        let dados = {
            "nome": $("#nome").val(),
            "sexo": $("#sexo").val(),
            "nasc": $("#nasc").val(),
            "documento": $("#documento").val()
        }

        if (dados.nome.length > 0 && dados.sexo.length > 0 && dados.nasc.length > 0 && dados.documento.length > 0) {
            $.ajax({
                url: '../paciente/',
                type: 'POST',
                data: JSON.stringify(dados),
                contentType: "application/json",
                success: function(response) {
                    $('#modalFooter').html('<div class="alert alert-success" role="alert">Paciente cadastrado com Sucesso! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                    $('#listaPacientes').html('');
                    listaPacientes();
                },
                error: function(response) {
                    console.log(response);
                    $('#modalFooter').html('<div class="alert alert-danger" role="alert">Problema de comunicação com a API REST <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                }
             });
        } else {
            $('#modalFooter').html('<div class="alert alert-danger" role="alert">Preencha os dados corretamente <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
        }
    });
  }

  function cadastraPront(obj) {
    let data =  $("#data").val();
    let hora = $("#hora").val();
    let descricao = $("#descricao").val();
    let partesData = data.split("-");
    let now = new Date;
    let dataForm = new Date(partesData[0], partesData[1] - 1, partesData[2]);
    let validaData = (dataForm.getDate() >= now.getDate() && dataForm.getMonth() >= now.getMonth() && dataForm.getFullYear() >= now.getFullYear() || dataForm.getFullYear() > now.getFullYear());

    if(validaData) {
        if (data.length === 10 && hora.length === 5 && descricao.length > 1) {

            let dados = {
                "id": 0,
                "descricao": descricao,
                "data_pront": data+" "+hora,
                "paciente": obj
            }

            $.ajax({
                url: '../prontuario/',
                type: 'POST',
                data: JSON.stringify(dados),
                contentType: "application/json",
                success: function(response) {
                    $('#listaPacientesConsulta').html('');
                    alert("Consulta cadastrada com sucesso! Para vê-la e edita-la vá até o card 'Atendidos' e clique em 'Consultas' desse paciente.");
                    consultorio.moduloT.listaPacientesConsulta();
                }
             });
        } else {
            alert("Preencha todos os campos do formulário corretamente.");
        }
    } else {
        alert("Não é possivel cadastrar datas passadas.");
    }
 }
 
 function salvaPront() {
    let now = new Date;
    let mes = now.getMonth()+1;
    let data = now.getFullYear()+"/"+mes+"/"+now.getDate();
    let hora = $("#hora").val();
    
    if(hora.length === 5) {
        let dados = {
            "id": $("#idPront").val(),
            "descricao": $("#descricao").val(),
            "data_pront": data+" "+hora,
            "paciente": $("#paciente").val()
        }

        if (dados.id.length > 0 && dados.descricao.length > 0 && dados.data_pront.length > 0 && dados.paciente.length > 0) {
            $.ajax({
                url: '../prontuario/'+$("#idPront").val(),
                type: 'PUT',
                data: JSON.stringify(dados),
                contentType: "application/json",
                success: function(response) {
                  $('#textoConsulta').html("Consulta em "+data+" - Edite esse prontuário");
                  alert("Prontuario atualizado com sucesso.");
                },
                error: function(response) {
                    console.log(response);
                    alert("Problema de comunicação com a API REST");
                }
             });
        }
    } else {
        alert("Você precisa preencher corretamente a hora");
    }
 }

  function listaPacientes() {
    $.ajax({
        url: "../paciente/"
    }).then(function(data) {
        const dados = JSON.parse(data);
        if(dados.length > 0) {
            let pacientes = document.getElementById('listaPacientes');
            dados.forEach(obj => {
                pacientes.innerHTML += `<div class="list-group-item list-group-item-action">
                                            <span id="selectPacient${obj.id}">
                                                ${obj.nome}
                                            </span>
                                            <button type="button" class="btn btn-warning btn-sm float-right" onclick="consultorio.moduloT.novaConsulta(${obj.id});">+Consulta</button>
                                            <input type="hidden" id="lista${obj.id}" name="teste" value="teste" />
                                        </div>`;
            });
        } else{
            $('#listaPacientes').html('<div class="alert alert-info alert-dismissible fade show" role="alert"> <strong>Opa!</strong> Nenhum paciente cadastrado.</div>');
        }
    }); 
  }

  function listaPacientesConsulta() {
    $.ajax({
        url: "../pacienteconsulta/"
    }).then(function(data) {
        const dados = JSON.parse(data);
        
        if(dados.length > 0) {
            let pacientes = document.getElementById('listaPacientesConsulta');
            dados.forEach(obj => {
                pacientes.innerHTML += `<div class="list-group-item list-group-item-action">
                                            ${obj.nome}
                                            <button type="button" class="btn btn btn-success btn-sm float-right" onclick="consultorio.moduloT.content(${obj.id});">
                                                Consultas
                                            </button>
                                            <input type="hidden" id="consul${obj.id}" name="" value="${obj.nome}" />
                                        </div>`;
            });
        } else {
            $('#listaPacientesConsulta').html('<div class="alert alert-info alert-dismissible fade show" role="alert"> <strong>Opa!</strong> Nenhum paciente com prontuário cadastrado.</div>');
        }
    }); 
  }
  
  function novaConsulta(obj) {
    let nome = $("#selectPacient"+obj).text();
    
    $('#titulopaciente').text('Paciente '+nome);
    $('#textoConsulta').html("Marcação de prontuario - Cadastre a data, horário e a descrição desse prontuário.");
    $("#salvar").attr("disabled", false);
    $('#listProntuario').html('');
    $('#buttonSave').html('');
    $('#listProntuario').html('<form id="formPront"> <input class="form-control" type="date" id="data" name="data" style="margin: 1em; max-width:620px;" value="2020-08-22" required> <input class="form-control" type="time" id="hora" name="hora" style="margin: 1em; max-width:620px;" value="08:00" required> <textarea id="descricao" style="margin: 1em; min-height:230px; max-width:620px;" class="form-control" rows="3" required>Descreva o Prontuário aqui.</textarea> <input type="hidden" id="idPacient" name="idPacient" value="'+obj+'" /></form>');
    $('#buttonSave').html('<button id="cadastrar" type="button" class="btn btn-lg btn-primary" onclick="consultorio.moduloT.cadastraPront('+obj+');">Salvar Consulta</button>');
  }

  function content(obj) {
    let nome = $("#consul"+obj).val();
    $('#titulopaciente').text('Paciente '+nome);
    $.ajax({
        url: "../consultaspacientes/"+obj
    }).then(function(data) {
        const dados = JSON.parse(data);
        $('#listProntuario').html("");
        $('#textoConsulta').html("Listando consultas já marcadas");
        $('#buttonSave').html('');
        let pacientes = document.getElementById('listProntuario');
        dados.forEach(obj => {
            pacientes.innerHTML += `<div id="prontid${obj.id}" class="list-group-item list-group-item-action">
                                        <a href="#" onclick="consultorio.moduloT.editorProntuario(${obj.id});">
                                        Consulta - ${obj.data_pront.date.substr(-30, 16)}
                                        </a>
                                        <button type="button" id="excluir" class="btn btn btn-danger btn-sm float-right" onclick="consultorio.moduloT.excluiPront(${obj.id});">
                                        Excluir
                                        </button>
                                    </div>`;
        });
    }); 
 }

 function editorProntuario(id) {
    $('#listProntuario').html("");
    $.ajax({
        url: "../prontuario/"+id
    }).then(function(data) {
        const dados = JSON.parse(data);
        let datahora = dados.data_pront.date.substr(-30, 16);
        let horaForm = dados.data_pront.date.substr(-15, 5);
        
        $('#buttonSave').html('');
        $('#textoConsulta').html("Consulta em "+datahora+" - Edite o horário e a descrição desse prontuário");
        $("#salvar").attr("disabled", false);
        let pacientes = document.getElementById('listProntuario');
        $('#listProntuario').html('<form id="formPront"> <input class="form-control" type="time" id="hora" name="hora" style="margin: 1em; max-width:620px;" value="'+horaForm+'" required> <textarea id="descricao" style="margin: 1em; min-height:290px; max-width:620px;" class="form-control" rows="3">'+dados.descricao+'</textarea> <input type="hidden" id="idPront" name="idPront" value="'+dados.id+'" /> <input type="hidden" id="paciente" name="idPront" value="'+dados.paciente+'" /></form>');
        $('#buttonSave').html('<button id="salvar" type="button" class="btn btn-lg btn-primary" onclick="consultorio.moduloT.salvaPront();">Salvar Consulta</button>');
    }); 
 }

 function excluiPront(id) {
    let resposta = confirm("Você realmente deseja excluir esse prontuário de consulta?");
    if (resposta && id) {
        $.ajax({
            url: '../prontuario/'+id,
            type: 'DELETE',
            success: function(response) {
                alert("Consulta excluida com sucesso.");
                $("#prontid"+id).remove();
                $('#listaPacientesConsulta').html('');
                listaPacientesConsulta();
                
                if ($('#listProntuario').html().length === 0) {
                    $('#listProntuario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>Opa!</strong> Nada a ser exbido aqui. Começe cadastrando Pacientes e Consultas =). </div>');
                }
                if ($('#listaPacientesConsulta').html().length === 0) {
                    $('#listaPacientesConsulta').html('<div class="alert alert-info alert-dismissible fade show" role="alert"> <strong>Opa!</strong> Nenhum paciente com prontuário cadastrado.</div>');
                }
            }
         });
    }
 }

  function limpaForm() {
        $('#formCadastroPaciente').each (function(){
            this.reset();
        });
    }

    return {
        iniciar:iniciar,
        salvaPront: salvaPront,
        listaPacientes: listaPacientes,
        listaPacientesConsulta: listaPacientesConsulta,
        limpaForm:limpaForm,
        cadastraPaciente: cadastraPaciente,
        cadastraPront: cadastraPront,
        novaConsulta: novaConsulta,
        content: content,
        editorProntuario: editorProntuario,
        excluiPront: excluiPront
    };

}());

consultorio.moduloT.iniciar();