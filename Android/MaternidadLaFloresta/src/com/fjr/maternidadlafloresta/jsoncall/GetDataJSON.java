package com.fjr.maternidadlafloresta.jsoncall;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.StatusLine;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.util.Log;

/**
 * 
 * @author frojas
 *
 */
public class GetDataJSON{
	private static final String JSON_URL = "http://cola.distritohosting.com/scolav2/json/llamadas.php";
	
	/**
	 * 
	 */
	private GetDataJSON() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 */
	public static String getLLamadas(){
		StringBuilder builder = new StringBuilder();
	    
	    String jsonResult = null;
	    HttpEntity entity  = null;
		InputStream content  = null;
		BufferedReader reader = null;
		
	    try {
	    	HttpClient client = new DefaultHttpClient();
		    HttpGet httpGet = new HttpGet(JSON_URL);
		    HttpResponse response = client.execute(httpGet);
	    	StatusLine statusLine = response.getStatusLine();
	    	int statusCode = statusLine.getStatusCode();
	    	
	    	if (statusCode == 200) {
	    		entity = response.getEntity();
	    		content = entity.getContent();
	    		reader = new BufferedReader(new InputStreamReader(content));
	        
	    		while ((jsonResult = reader.readLine()) != null) {
	    			builder.append(jsonResult);
	    		}
	    	} else {
	    		Log.e(GetDataJSON.class.toString(), "Failed to download file");
	    	}
	    } catch (IOException e) {
	    	e.printStackTrace();
	    } catch (Exception e) {
	    	e.printStackTrace();
	    } finally {
	    	try {
	    		reader.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
	    	
	    	try {
				content.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}	    	
	    }
	    
	    return jsonResult;
	}
}
