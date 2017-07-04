<?php include __DIR__ . '/../layouts/header.php' ?>

<div id="content" style="display: none;">
    <h1>Meus clientes</h1>
    <button type="button">Novo</button>
    <table id="table" class="table">
        <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Tel.</th>
            <th>Aniver.</th>
            <th>Estado Civil</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div id="client-dialog" title="Criar novo cliente">
    <form>
        <input type="hidden" name="id">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
        </div>
        <div class="form-group">
            <label for="name">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="birthday">Aniversário</label>
            <input type="text" class="form-control" id="birthday" name="birthday" required>
        </div>
        <div class="form-group">
            <label for="marital_status">Estado Civil</label>
            <select class="form-control" id="marital_status" name="marital_status" required>
                <option value="1">Solteiro</option>
                <option value="2">Casado</option>
                <option value="3">Divorciado</option>
            </select>
        </div>

        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </form>
</div>

<div id="delete-dialog" title="Exclusão de cliente">
    <p><span class="ui-icon ui-icon-alert"></span>Deseja excluir este cliente</p>
</div>
<?php include __DIR__ . '/../layouts/footer.php' ?>
<script type="text/javascript">

    function showNotificationError(text) {
        new PNotify({
            title: 'Mensagem de erro',
            text: text,
            styling: 'brighttheme',
            type: 'error'
        });
    }

    function showLoading(text){
        new PNotify({
            text: text,
            styling: 'brighttheme',
            type: 'info',
            hide: false,
            addclass: 'stack-modal',
            stack: {
                dir1: 'down',
                dir2: 'right',
                modal: true,
                overlay_close: true
            }
        });
    }
    function listClients() {
        var loading = '<tr><td colspan="6">Carregando...</td></tr>',
            empty = '<tr><td colspan="6">Nenhum registrado encontrado</td></tr>';
        var tbody = $('#table>tbody');
        tbody.html(loading);
        $.get('/api/clients', function (data) {
            data.length ? tbody.empty() : tbody.html(empty);
            var btnEdit = $('<button/>').attr('type', 'button').html('Editar');
            var btnDelete = $('<button/>').attr('type', 'button').html('Excluir');
            for (var key in data) {
                var tr = $('<tr/>'),
                    row = data[key],
                    name = $('<td/>').html(row.name),
                    cpf = $('<td/>').html($.formatCpf(row.cpf)),
                    email = $('<td/>').html(row.email),
                    phone = $('<td/>').html($.formatPhone(row.phone)),
                    birthday = $('<td/>').html($.formatDate(row.birthday)),
                    marital_status = $('<td/>').html($.formatMaritalStatus(row.marital_status));

                var actions = $('<td/>');
                actions.append(btnEdit.clone())
                    .append(btnDelete.clone());

                tr.data('client-id', row.id);

                tr.append(name)
                    .append(cpf)
                    .append(email)
                    .append(phone)
                    .append(birthday)
                    .append(marital_status)
                    .append(actions);

                tbody.append(tr);
            }
            tbody
                .find('button:contains(Editar)').button({
                icon: 'ui-icon-pencil'
            })
                .click(function () {
                    var button = $(this),
                        tr = button.closest('tr'),
                        id = tr.data('client-id');
                    loadEditForm(id);
                });
            tbody
                .find('button:contains(Excluir)').button({
                icon: 'ui-icon-trash'
            })
                .click(function () {
                    var button = $(this),
                        tr = button.closest('tr'),
                        index = tr.index(),
                        id = tr.data('client-id');
                    $('#delete-dialog').data('delete_id', id);
                    $('#delete-dialog').data('delete_index', index);

                    dialogDelete.dialog('open');
                })
        }).fail(function () {
            showNotificationError('Não foi possível consultar os clientes');
        });
    }

    function loadEditForm(id) {
        showLoading('Carregando cliente...');
        $.get('/api/clients?id=' + id, function (data) {
            PNotify.removeAll();
            var client = data[0];
            $('input[name=id]').val(client.id);
            $('input[name=name]').val(client.name);
            $('input[name=email]').val(client.email);
            $('input[name=cpf]').val(client.cpf);
            $('input[name=phone]').val(client.phone);
            $('input[name=birthday]').val(client.birthday);
            $('select[name=marital_status]').val(client.marital_status);
            dialogSave.dialog('open');
        }).fail(function () {
            PNotify.removeAll();
            setTimeout(function(){
                showNotificationError('Não foi possível carregar este cliente');
            },4000);
        });
    }

    function saveClient() {
        var data = $('#client-dialog>form').serializeObject(),
            id = $('input[name=id]').val(),
            url;

        data.cpf = data.cpf.replace(/[^0-9]/g, '');
        data.phone = data.phone.replace(/[^0-9]/g, '');
        //07/07/2017 -> 2017-07-07
        data.birthday = data.birthday.split('/').reverse().join('-');

        if (id == "") {
            url = '/api/clients/store';
            delete data.id;
        } else {
            url = '/api/clients/update';
        }

        $.post(url, data)
            .done(function () {
                dialogSave.dialog('close');
                listClients();
            })
            .fail(function () {
                showNotificationError(
                    id==""
                        ?'Não foi possível inserir o cliente'
                        :'Não foi possível alterar o cliente');
            });
    }

    function deleteClient() {
        var id = $('#delete-dialog').data('delete_id'),
            index = $('#delete-dialog').data('delete_index');
        $.post('/api/clients/delete', {id: id})
            .done(function () {
                $('#table>tbody tr').eq(index).remove();
                dialogDelete.dialog('close');
            })
            .fail(function () {
                showNotificationError('Não foi possível excluir este cliente');
            });
    }

    var dialogSave, dialogDelete;
    function init() {
        dialogSave = $('#client-dialog')
            .dialog({
                autoOpen: false,
                height: 400,
                width: 400,
                modal: true,
                buttons: {
                    "Criar cliente": saveClient,
                    "Cancelar": function () {
                        //$(this).dialog('close');
                        dialogSave.dialog('close');
                    }
                },
                close: function () {
                    $('#client-dialog>form')[0].reset();
                    $('#client-dialog>form').find('input[type=hidden]').val("");
                }
            });
        dialogDelete = $('#delete-dialog')
            .dialog({
                autoOpen: false,
                resizable: false,
                height: "auto",
                modal: true,
                buttons: {
                    "OK": deleteClient,
                    "Cancelar": function () {
                        $(this).dialog('close');
                    }
                }
            });
        $('#client-dialog>form').on('submit', function (event) {
            event.preventDefault();
            saveClient();
        })
        $('#content>button').button({
            icon: 'ui-icon-plus'
        }).click(function () {
            dialogSave.dialog('open');
        });
        $('input[name=cpf]').mask('000.000.000-00');
        var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('input[name=phone]').mask(SPMaskBehavior, spOptions);
        $('input[name=birthday]').datepicker();
        $('#content').show('slide');
        listClients();
    }
    $(document).ready(function () {
        init();
    })

</script>
<?php include __DIR__ . '/../layouts/end.php' ?>
