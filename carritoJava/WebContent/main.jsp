<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<jsp:include page="includes/header.jsp"></jsp:include>

    <div id="page-padding">
        <!-- empezar contenido -->
        <div id="content">
            <div id="content-padding">
                <h1>Buscar Los Productos Deseados  </h1>
            
                <div class="contLbl">
                    <bean:define id="indexVOForm" type="com.carrito.vo.IndexVO" name="indexVOForm" scope="request" />
    
                    <label>Categor&iacute;a</label>
					<select id="pedido">
					    <option value="0">Seleccione una opci&oacute;n...</option>
					    <logic:iterate id="listadoCategorias" name="indexVOForm" property="categorias">
					        <option value="<bean:write name="listadoCategorias" property="id"/>">
					            <bean:write name="listadoCategorias" property="nombre"/>
					        </option>
					    </logic:iterate>
    				</select>
                </div>
                <div id="ajaxAnswer"></div>
            </div>
        </div>
        <!-- end content -->
        
        <div id="right-nav">
          <!-- right side menu, copy and paste what is contained between these start and end comment tags to make an extra menu -->
          <div class="right-nav-back">
            <div class="right-nav-top">
              <p>. : Carrito </p>
            </div>
            <ul>
              <li>

              </li>
            </ul>
            <p>&nbsp;</p>
            <table class="centered">
              <tbody>
                <tr>
                  <td width="269" class="Titolmenu columnMenuHeader" id="minibasketHeader"><a href="irecionnnnn* *********" class="Titolmenu" style="color:#fff;">Cesta</a> </td>
                </tr>
                <tr>
                  <td id="minibasketMiddle"><table width="263" height="158" class="centered">
                      <tbody>
                        <tr>
                          <td width="255" class="Textmenu" style="padding-top:5px;padding-right:1px;padding-left:2px"><form action="irecionnnnn* *********" method="post">
                              <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
                                <tbody>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="irecionnnnn* *********" class="text"> Galletera y... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">13.95 ?</td>
                                  </tr>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="direcionnnnn* *********" class="text"> Boquilla Pa... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">4.45 ?</td>
                                  </tr>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="direccion *********************" class="text"> Juego de Co... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">4.05 ?</td>
                                  </tr>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="direcionnn *******************" class="text"> Papel para ... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">2.50 ?</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" bgcolor="#ffffff"><img src="direccion de imagen ***************" border="0" height="1" /></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style=" background-color:#bdbdbe; height:1px;"></td>
                                  </tr>
                                  <tr>
                                    <td class="text" style="font-weight:bold; height:25px;" align="left" valign="middle">4&nbsp;u.</td>
                                    <td colspan="2" class="text" style="font-weight:bold;" align="right" valign="middle"> 24.96 ? </td>
                                  </tr>
                                </tbody>
                              </table>
                          </form></td>
                        </tr>
                        <tr>
                          <td class="textmenu" style="padding:3px; padding-right:7px;" align="right"><a href="direccion ***************" class="textmenu"> ver cesta </a> </td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td id="minibasketBottom"></td>
                </tr>
              </tbody>
            </table>
            <p><br />
              <br />
              <br />
            </p>
            <div class="right-nav-bottom"></div>
          </div>
          <!-- end right side menu -->
          <!-- comienza menu  de boletines -->
          <div class="right-nav-back">
            <div class="right-nav-top"><p>. : Subscribete a nuestros boletines </p></div>
              <br />
              <div id="subscribe">
                <form action="yourformmailhere" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="sendtoemail" value="youremailaddress" />
                  <input type="hidden" name="redirect" value="yourwebsiteaddress" />
                  <input type="hidden" name="subject" value="Newsletter subscription from your website" />
                  <input name="name" type="text" placeholder="Nombre" class="inputstyle" />
                  <input name="email" type="text" placeholder="Direccion de correo" class="inputstyle" />
                  <input type="submit" value="subscribe" class="button" />
                </form>
              </div>
            <div class="right-nav-bottom"></div>
          </div>
          <!-- fin menu  de boletines -->
          <br /><br /><br /><br /><br /><br />
        </div>
      </div>

<jsp:include page="includes/footer.jsp"></jsp:include>