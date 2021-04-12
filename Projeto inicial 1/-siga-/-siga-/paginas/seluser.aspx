<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="seluser.aspx.cs" Inherits="_SIGA_.PAGINAS.seluser" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style type="text/css">
        .auto-style2 {
            position: fixed;
            left: 816px;
            top: 19px;
        }
    </style>
</head>
<body>
    <form id="form1" runat="server">
   
        <div>
            <asp:GridView ID="gvuser" runat="server" AutoGenerateColumns="False" DataKeyNames="idusuario" DataSourceID="SqlDataSource1" OnSelectedIndexChanged="gvuser_SelectedIndexChanged" OnRowDeleted="gvuser_RowDeleted" Height="205px" OnRowDeleting="gvuser_RowDeleting" Width="434px">
                <Columns>            
                    <asp:BoundField DataField="idusuario" HeaderText="idusuario" InsertVisible="False" ReadOnly="True" SortExpression="idusuario" />
                    <asp:BoundField DataField="loginusuario" HeaderText="loginusuario" SortExpression="loginusuario" />
                    <asp:BoundField DataField="senhausuario" HeaderText="senhausuario" SortExpression="senhausuario" />
                    <asp:BoundField DataField="nomeusuario" HeaderText="nomeusuario" SortExpression="nomeusuario" />
                    <asp:BoundField DataField="funcaousuario" HeaderText="funcaousuario" SortExpression="funcaousuario" />                
 
                <asp:TemplateField>

                    <ItemTemplate>

                        <asp:Button ID="btnselecionarusuario" CommandArgument='<%# Container.DataItemIndex %>' runat="server" Text="Selecionar" />
                    </ItemTemplate>

                </asp:TemplateField>
                     <asp:TemplateField>
                    <ItemTemplate>
                        <asp:Button ID="btneditarusuario" CommandArgument='<%# Container.DataItemIndex %>' runat="server" Text="Editar" />
                    </ItemTemplate>
                </asp:TemplateField>

                <asp:TemplateField>
                    <ItemTemplate>
                        <asp:Button ID="btnexcluirusuario" CommandArgument='<%# Container.DataItemIndex %>' runat="server" Text="Excluir" />
                    </ItemTemplate>
                </asp:TemplateField>
                </Columns>

                <SelectedRowStyle BorderStyle="Solid" />
            </asp:GridView>


              <div class="auto-style2">
              login
            <asp:TextBox ID="txtlogin" runat="server"></asp:TextBox>
            <br />
            senha
            <asp:TextBox ID="txtsenha" runat="server"></asp:TextBox>
            <br />
            nome
            <asp:TextBox ID="txtnome" runat="server"></asp:TextBox>
            <br />
            função
            <asp:TextBox ID="txtfuncao" runat="server"></asp:TextBox>
            <br />
            <asp:Button ID="btnadd" runat="server" Text="Adicionar" OnClick="btnadd_Click" />
        </div>
            <asp:SqlDataSource ID="SqlDataSource1" runat="server" ConnectionString="<%$ ConnectionStrings:ConnectionString %>" SelectCommand="SELECT * FROM [USUARIO]" OnSelecting="SqlDataSource1_Selecting"></asp:SqlDataSource>
        </div>
    </form>
</body>
</html>
