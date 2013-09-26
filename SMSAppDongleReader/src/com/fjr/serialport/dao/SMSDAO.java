package com.fjr.serialport.dao;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.Timestamp;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

import org.apache.log4j.Logger;

import com.fjr.serialport.dto.SMSDTO;
import com.fjr.code.util.DBConnectionUtil;

/**
 * 
 * Class: SMSDAO
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SMSDAO {
	private static final DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
	private static final DateFormat timeFormat = new SimpleDateFormat("H:m:s");
	
	
	private static final Logger log = Logger.getLogger(SMSDAO.class);
	
	/**
	 * 
	 * @param smsDTO
	 * @return
	 */
	public static final boolean storeSMSAtDataBase(SMSDTO smsDTO){
		final String query = "INSERT INTO mensajes (fecha_recibido, number_from, message_value) VALUES (?,?,?)";
		
		boolean wasStored = false;
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			con = DBConnectionUtil.getConnection();
			ps = con.prepareStatement(query);
			ps.setTimestamp(1, new Timestamp(smsDTO.getDateOfMessage().getTimeInMillis()));
			ps.setString(2, smsDTO.getNumberFrom());
			ps.setString(3, smsDTO.getMessage());
			
			ps.execute();
			log.info("Almacenado de manera exitosa el mensaje " + smsDTO);
			wasStored = true;
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error almacenando mensaje en base de datos, el error fue: "
					+ e.getLocalizedMessage() + " y los valores " + smsDTO, e);
		} finally {
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return wasStored;
	}
	
	/**
	 * 
	 * @param smsDTO
	 * @return
	 */
	public static final boolean storeSMSInReaderPHPSystem(SMSDTO smsDTO){
		boolean result = true;
		try {
			String url = "http://www.eftysistem.com/SMSManagerReader/addSMSFromRemote.php";
			URL obj = new URL(url);
			HttpURLConnection con = (HttpURLConnection) obj.openConnection();
			
			//add request header
			con.setRequestMethod("POST");
			con.setRequestProperty("User-Agent", "JAVA Program");
			con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
			
			String fecha = dateFormat.format(smsDTO.getDateOfMessage().getTime());
			String hora = timeFormat.format(smsDTO.getDateOfMessage().getTime());
			
			String urlParameters = "mensaje=" + URLEncoder.encode(smsDTO.getMessage(), "utf-8");
			urlParameters += "&remitente=" + smsDTO.getNumberFrom();
			urlParameters += "&fecha=" + fecha;
			urlParameters += "&hora=" + hora;
			urlParameters += "&KEY=SMSReaderAPP";
			
			// Send post request
			con.setDoOutput(true);
			DataOutputStream wr = new DataOutputStream(con.getOutputStream());
			wr.writeBytes(urlParameters);
			wr.flush();
			wr.close();
	 
			int responseCode = con.getResponseCode();
			log.info("Post parameters : " + urlParameters);
			log.info("Response Code : " + responseCode);
	 
			BufferedReader in = new BufferedReader(
			        new InputStreamReader(con.getInputStream()));
			String inputLine;
			StringBuffer response = new StringBuffer();
	 
			while ((inputLine = in.readLine()) != null) {
				response.append(inputLine);
			}
			in.close();
	 
			//print result
			log.info("Response: " + response.toString());
		} catch (Exception e) {
			// TODO: handle exception
			result = false;
			log.error(e.getMessage(), e);
		}
		
		return result;
	}
}
