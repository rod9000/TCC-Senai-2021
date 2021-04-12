<%@ Page Languge="C#" AutoEventWireup="true" CodeBehind="login.aspx.cs" Inherits="_siga_.paginas.login" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div style="border: 1px solid #000000; width:500px; height:250px; margin-left: auto; margin-right: auto; margin-top: 10%; box-shadow: 0 20px 20px rgba(0,0,0,.4); display: flex;">
    
        <div>
        <div style="border-color: inherit; border:thin;float:right;width:60%;height:100%">
        
              &nbsp;&nbsp<asp:Label ID="Label1" runat="server" Text="Siga"></asp:Label>
        <br />
            <br />
        &nbsp<asp:Label ID="Label2" runat="server" Text="Usuario"></asp:Label>
        <br />
        &nbsp<asp:TextBox ID="txtusuario" runat="server"></asp:TextBox>
        <br />
        &nbsp<asp:Label ID="Label3" runat="server" Text="Senha"></asp:Label>
        <br />
        &nbsp<asp:TextBox ID="txtsenha" runat="server"></asp:TextBox>
        <br />
            <br />
        &nbsp<asp:Button ID="btnacessar" runat="server" Text="Acessar" />
        <br />
        &nbsp<asp:Button ID="btnregistar" runat="server" Text="Registrar" />
            <br />
        </div>
            <img src="../imagens/logosiga.PNG" style="position: relative; width: 40%; height:100%;float:left" />
          
    </div>
    
    </div>        


    </form>
</body>
</html>
