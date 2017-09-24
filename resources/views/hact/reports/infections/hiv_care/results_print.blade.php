
@extends("hact.layouts.print_layout")

@section("content")
	<br/>
	<input id="print" type="button" value="Print">
	<script>
		$('#print').click(function(){
			$(this).hide();
			window.print();
			$(this).show();
		});
	</script>
	<br/>
	<br/>
	<table width="100%">
		<thead>
			<tr>
				<td colspan="5">
					<center>
						HIV Care Monthly Report
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<center>
						CORAZON LOCSIN MONTELIBANO MEMORIAL REGIONAL HOSPITAL
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<center>
						Reporting Period {{ $from }} - {{ $to }}
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="5">
				</td>
			</tr>
		<thead>
		<tbody>
			<tr>
				<td colspan="3">
					Total Number of PLHIV seen on initial/first contact during reporting period:
				</td>
				<td colspan="1">
					{{ $plhiv_count }}
				</td>
				<td colspan="1">
					
				</td>
			</tr>
			<tr>
				<td colspan="3">
					No. of PLHIV screened for TB during reporting period:
				</td>
				<td colspan="1">
					{{ $plhiv_tb }}
				<td colspan="1">
				</td>	
			</tr>
			<tr>
				<td colspan="3">
					No. of PLHIV started om IPT during reporting period:
				</td>
				<td colspan="1">
					{{ $plhiv_tb_ipt }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					Total No. of Opportunistic Infections diagnosed:
				</td>
				<td colspan="1">
					{{ $oi_count }}
				</td>
				<td colspan="1">

				</td>
			</tr>



			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> Pneumocystis Carinii Pneumonia(PCP) 
				</td>
				<td colspan="1">
					{{ $pcp_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> Candidiasis
				</td>
				<td colspan="1">
					{{ $candidiasis_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> CMV
				</td>
				<td colspan="1">
					{{ $cmv_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> MAC
				</td>
				<td colspan="1">
					{{ $mac_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> TB
				</td>
				<td colspan="1">
					{{ $tb_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> Other Ois
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
			</tr>



			<tr>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
					> Syphilis
				</td>
				<td colspan="1">
					{{ $syphilis_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
					> Herpes Simplex
				</td>
				<td colspan="1">
					{{ $herpes_simplex_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
					> Anal Warts
				</td>
				<td colspan="1">
					{{ $anal_warts_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
					> Endocarditis
				</td>
				<td colspan="1">
					{{ $endocarditis_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
					> Hepatitis B
				</td>
				<td colspan="1">
					{{ $hepatitis_b_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="1">
				</td>
				<td colspan="1">
					> Kaposi's Sarcoma
				</td>
				<td colspan="1">
					{{ $kaposis_sarcoma_count }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					No. of PLHIV started on TB tx during reporting period:
				</td>
				<td colspan="1">
					{{ $plhiv_tb_tx }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="3">
					No. of PLHIV provided PMTCT services during reporting period:
				</td>
				<td colspan="1">
					{{ $plhiv_pmtct }}
				</td>
				<td colspan="1">
				</td>
			</tr>

			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> No. of pregnant PLHIV assessed for ART eligibility
				</td>
				<td colspan="1">
					{{ $plhiv_pregnant_art }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> No. of pregnant PLHIV started on ARV prophylaxis
				</td>
				<td colspan="1">
					{{ $plhiv_pregnant_arv }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> No. of NB started on ARV prophylaxis
				</td>
				<td colspan="1">
					{{ $plhiv_nb_arv }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="1">
				</td>
				<td colspan="2">
					> No. of infants on Cotri prophylaxis
				</td>
				<td colspan="1">
					{{ $plhiv_infants_cotri }}
				</td>
				<td colspan="1">
				</td>
			</tr>

			<tr>
				<td colspan="3">
					No. of PLHIV started on ART during reporting period
				</td>
				<td colspan="1">
					{{ $plhiv_art }}
				</td>
				<td colspan="1">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					&nbsp;
				</td>
				<td colspan="2">
					<div>Generated By:<br/>
						Name: {{ Auth::user()->name }}<br/>
						Email: {{ Auth::user()->email }}
					</div>
				</td>
			</tr>
		</tbody>
	</table>

@endsection
