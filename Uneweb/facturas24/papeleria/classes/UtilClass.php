<?php
class UtilClass {
	public static function buildFontTable($numberElement){
		$elementFontName = "font".$numberElement;
		$elementFontSize = "fontSize".$numberElement;
		$elementFontBold = "fontBold".$numberElement;
		$elementFontCursiva = "fontCursiva".$numberElement;
		
		$table = "<table>
  						<tr>
  							<td>
  								<select name=\"".$elementFontName."\" id=\"".$elementFontName."\" class=\"formModelo\">
				  					<option value=\"AdrianRegular\">AdrianRegular</option>
				  					<option value=\"Aeolus\">Aeolus</option>
				  					<option value=\"Aero\">Aero</option>
				  					<option value=\"Alba\">Alba</option>
				  					<option value=\"AmeliaBT\">AmeliaBT</option>
				  					<option value=\"Annifont\">Annifont</option>
				  					<option value=\"Anson\">Anson</option>
				  					<option value=\"ArcaneWide\">ArcaneWide</option>
				  					<option value=\"ArchiesHand\">ArchiesHand</option>
				  					<option value=\"Arial\">Arial</option>
				  					<option value=\"ArialNarrowBold\">ArialNarrowBold</option>
				  					<option value=\"AvantGardeBook\">AvantGardeBook</option>
				  					<option value=\"AvantGardeBookOblique\">AvantGardeBookOblique</option>
				  					<option value=\"AvantGuard\">AvantGuard</option>
				  					<option value=\"AvantGuardBold\">AvantGuardBold</option>
				  					<option value=\"Azrael\">Azrael</option>
				  					<option value=\"BahamasHeavy\">BahamasHeavy</option>
				  					<option value=\"BankGothic\">BankGothic</option>
				  					<option value=\"BankGothicMedium\">BankGothicMedium</option>
				  					<option value=\"BauhausItc\">BauhausItc</option>
				  					<option value=\"Bedrock\">Bedrock</option>
				  					<option value=\"Birdman\">Birdman</option>
				  					<option value=\"BirdmanBold\">BirdmanBold</option>
				  					<option value=\"BirdmanLight\">BirdmanLight</option>
				  					<option value=\"Bodoni\">Bodoni</option>
				  					<option value=\"BodoniBlack\">BodoniBlack</option>
				  					<option value=\"BodoniBold\">BodoniBold</option>
				  					<option value=\"CenturyGothic\">CenturyGothic</option>
				  					<option value=\"CenturyGothicBold\">CenturyGothicBold</option>
				  					<option value=\"CenturyGothicCursiva\">CenturyGothicCursiva</option>
				  					<option value=\"Coronet\">Coronet</option>
				  					<option value=\"CoronetBecker\">CoronetBecker</option>
				  					<option value=\"CurlyJoe\">CurlyJoe</option>
				  					<option value=\"English111Vivace\">English111Vivace</option>
				  					<option value=\"Futura2-Normal\">Futura2-Normal</option>
				  					<option value=\"FuturaMediana\">FuturaMediana</option>
				  					<option value=\"Gazette\">Gazette</option>
				  				</select>
  							</td>
  							<td align=\"right\">
  								<select name=\"".$elementFontSize."\" id=\"".$elementFontSize."\" class=\"formModelo\">
				  					<option value=\"13\">13</option>
				  					<option value=\"14\">14</option>
				  					<option value=\"15\">15</option>
				  					<option value=\"16\">16</option>
				  					<option value=\"17\">17</option>
				  					<option value=\"18\">18</option>
				  					<option value=\"19\">19</option>
				  					<option value=\"20\">20</option>
				  					<option value=\"21\">21</option>
				  					<option value=\"22\">22</option>
				  					<option value=\"23\">23</option>
				  					<option value=\"24\">24</option>
				  					<option value=\"25\">25</option>
				  					<option value=\"26\">26</option>
				  				</select>
  							</td>
  						</tr>
  						<tr>
  							<td>
  								<input type=\"checkbox\" name=\"".$elementFontBold."\" id=\"".$elementFontBold."\"> Negrita
  							</td>
  							<td align=\"right\">
  								<input type=\"checkbox\" name=\"".$elementFontCursiva."\" id=\"".$elementFontCursiva."\"> Cursiva
  							</td>
  						</tr>
  					</table>";
		
		return $table;
	}
}
?>