<%@page contentType="text/html"%>
<%@page pageEncoding="UTF-8"%>
<!DOCTYPE html>
<%!
	String text="";
%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
    	<%
    		request.setCharacterEncoding("utf-8");
    		String yourname=request.getParameter("name1");
    		out.println(yourname);
    		if(yourname == null){
    			yourname="";
    		}
    		text += yourname;
    		out.println("<br>"+text);
    	%>
 	</body>
</html>