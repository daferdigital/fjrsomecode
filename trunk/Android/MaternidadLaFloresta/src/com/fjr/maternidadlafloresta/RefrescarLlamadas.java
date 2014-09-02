package com.fjr.maternidadlafloresta;

import java.util.HashMap;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.fjr.maternidadlafloresta.jsoncall.GetDataJSON;
import com.fjr.maternidadlafloresta.util.MediaPlayerUtil;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;

/**
 * Async task class to get json by making HTTP call
 * 
 * @author frojas
 *
 */
public class RefrescarLlamadas extends AsyncTask<Void, Void, Void> {
	private static final String TAG_LINEA_LLAMADA = "lineaLlamada";
	private static final String TAG_LLAMADAS = "llamadas";
	private static final String TAG_NUMERO = "numero";
	private static final String TAG_UNIDAD = "unidad";
	
	private MainActivity parentView;
	private ProgressDialog pDialog; 
	private JSONArray llamadas = null;
	
	/**
	 * 
	 * @param parentView
	 */
	public RefrescarLlamadas(MainActivity parentView) {
		// TODO Auto-generated constructor stub
		this.parentView = parentView;
	}
	
	
	@Override
	protected void onPreExecute() {
		super.onPreExecute();
		// Showing progress dialog
		pDialog = new ProgressDialog(parentView.getBaseContext());
		pDialog.setMessage("Refrescando...");
		pDialog.setCancelable(false);
		pDialog.show();
	}
	
	@Override
	protected Void doInBackground(Void... arg0) {
		String jsonStr = GetDataJSON.getLLamadas();
		
		if (jsonStr != null) {
			try {
				JSONObject jsonObj = new JSONObject(jsonStr);
				// Getting JSON Array node
				llamadas = jsonObj.getJSONArray(TAG_LLAMADAS);
				
				// looping through All Contacts
				for (int i = 0; i < llamadas.length(); i++) {
					JSONObject c = llamadas.getJSONObject(i);
					// tmp hashmap for single contact
					HashMap<String, String> llamada = new HashMap<String, String>();
					llamada.put(TAG_LINEA_LLAMADA, c.getString(TAG_UNIDAD) + ": " + c.getString(TAG_NUMERO));

					// adding contact to contact list
					parentView.getListaLlamadas().add(llamada);
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}
		} else {
			Log.e("ServiceHandler", "Couldn't get any data from the url");
		}
		
		return null;
	}
		
	@Override
	protected void onPostExecute(Void result) {
		super.onPostExecute(result);
		
		// Dismiss the progress dialog
		if (pDialog.isShowing()){
			pDialog.dismiss();
		}
		
		/*
		 * Updating parsed JSON data into ListView
		 */
		
		ListAdapter adapter = new SimpleAdapter(
				parentView.getBaseContext(), 
				parentView.getListaLlamadas(),
				R.layout.list_item,
				new String[] {TAG_LINEA_LLAMADA},
				new int[] { R.id.llamada_item});
		
		parentView.setListAdapter(adapter);
		
		MediaPlayerUtil.playSound(R.raw.timbre, parentView.getBaseContext());
	}
}
