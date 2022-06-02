<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Feuille de Soin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <style>
        label{
            font-size: smaller;
        }
        table, th, td {
            border: 5px solid #e8fcee;
        }

        table {
            border-spacing: 25px;
        }
    </style>
</head>
<body>
<div class="flex-center ">
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="row m-0 p-0 d-flex flex-row ">
                <div class="col-6 d-flex flex-column p-0">
                    <img src="/assets/img/images/assurance/cnamgspic.png" alt="" width="100%" height="65%">
                    <br>
                    <p class="" style="font-size: 9px">B.P.3999 Libreville - Gabon - Tél.: (241) 011 77 59 65 / 66 / 67 / 68 - Fax: (241) 011 77 59 64 - Web: www.cnamgs.com </p>
                </div>
                <div class="col-3 d-flex flex-column justify-content-center">
                    <h2 class="text-left fw-bolder mb-2">GEF</h2>
                    <p class="mb-0">__________________________</p>
                    <p class="text-sm">Date reception CNAMGS</p>
                </div>
                <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                  <h2>Feuille de soins</h2>
                    Volet n°1 (CNAMGS)
                </div>
            </div>
            <p class="mx-1 mb-0 px-2" style="background-color: #72B46E;color: black;font-size: x-large;padding-left: inherit;font-weight: bold;margin-top: -36px;">Patient</p>
            <div class="row px-4 mx-1" style="background-color: #e8fcee;">
                <div class="col-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nomPrenom" class="form-label">Noms Et Prénoms du Patient</label>
                            <input type="text" class="form-control form-control-sm" id="nomPrenom" aria-describedby="nomPrenom">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="dateNaiss" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control form-control-sm" id="dateNaiss" value="">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="immatri" class="form-label">Numéro d'Immatriculation du Patient</label>
                            <input type="password" class="form-control form-control-sm" id="immatri">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="nomsAss" class="form-label">Noms et Prénom de l'assuré</label>
                            <input type="text" class="form-control form-control-sm" id="nomsAss">
                            <div id="nomsAss" class="form-text">(si le patient n'est pas l'assuré)</div>
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="immatric" class="form-label">Numéro d'Immatriculation du Patient</label>
                            <input type="text" class="form-control form-control-sm" id="immatric">
                            <div id="immatric" class="form-text">(si le patient n'est pas l'assuré)</div>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nomPrenom" class="form-label">Situation du Patient</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ass" value="option1">
                                <label class="form-check-label" for="ass">Assuré</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add" value="option2">
                                <label class="form-check-label" for="add">Ayant Droit</label>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bolder">Signature du Patient <span class="fw-lighter">(Obligatoire)</span></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <p class="mx-1 mb-0 px-2" style="background-color: #72B46E;color: black;font-size: x-large;padding-left: inherit;font-weight: bold;margin-top: 1px;">Praticien</p>
            <div class="row px-4 mx-1" style="background-color: #e8fcee;">
                <div class="col-9">
                    <div class="row pt-2">
                        <div class="col-md-6 mt-0">
                            <label for="nomsPrati" class="form-label">Noms Et Prénoms du Praticien</label>
                            <input type="text" class="form-control form-control-sm" id="nomsPrati" value="">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="codePra" class="form-label">Code du Praticien</label>
                            <input type="text" class="form-control form-control-sm" id="codePra">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="etablisse" class="form-label">Nom de l'Etablissement</label>
                            <input type="text" class="form-control form-control-sm" id="etablisse">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="codEta" class="form-label">Code de l'Etablissement</label>
                            <input type="text" class="form-control form-control-sm" id="codEta">
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bolder" style="font-size: 10px">Signature et cachet du Patient <span class="fw-lighter">(Obligatoire)</span></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="mx-1 mb-0 px-2" style="background-color: #72B46E;color: black;font-size: x-large;padding-left: inherit;font-weight: bold;margin-top: 1px;">Conditions de Prise en Charge</p>
            <div class="row px-4 mx-1" style="background-color: #e8fcee;">
                <div class="col-md-1">
                    <span style="font-size: 14px; text-align: right">Ticket Modérateur</span>
                </div>
                <div class="col-md-1">
                    <div class="form-check form-check-reverse">
                        <input class="form-check-input" type="checkbox" value="" id="pleinId">
                        <label class="form-check-label" for="pleinId">
                            Plein
                        </label>
                    </div>
                    <div class="form-check form-check-reverse">
                        <input class="form-check-input" type="checkbox" value="" id="pleinAld">
                        <label class="form-check-label" for="pleinAld">
                            Plein(ALD)
                        </label>
                    </div>
                    <div class="form-check form-check-reverse">
                        <input class="form-check-input" type="checkbox" value="" id="exonere">
                        <label class="form-check-label" for="exonere">
                            Exonéré
                        </label>
                    </div>

                </div>
                <div class="col-md-4">
                    <span class="inline-block" style="font-size: 14px">Accident Causé par un tiers</span>&nbsp;
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="wi" value="yes">
                        <label class="form-check-label" for="wi">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="non" value="no">
                        <label class="form-check-label" for="non">Non</label>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <span style="font-size: 14px">Si Oui,<br> date de l'accident</span>
                        </div>
                        <div class="col-7 d-flex flex-column align-items-center">
                            <input type="text" class="form-control form-control-sm my-auto" id="accident">
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex flex-column justify-content-center">
                    <span style="font-size: 14px; text-align: right">Soins liés à la grossesse</span>
                </div>
                <div class="col-md-1  d-flex flex-column justify-content-center">
                    <div class="form-check form-check-reverse">
                        <input class="form-check-input" type="checkbox" value="" id="wiwi">
                        <label class="form-check-label" for="wiwi">
                            Oui
                        </label>
                    </div>
                    <div class="form-check form-check-reverse">
                        <input class="form-check-input" type="checkbox" value="" id="nonon">
                        <label class="form-check-label" for="nonon">
                            Non
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row m-0">
                        <label for="datePreGross" class="col-sm-4 col-form-label d-flex flex-row align-content-end">
                            <span style="font-size: 10px; text-align: right">Date présumée <br> de début de grossesse</span>
                        </label>
                        <div class="col-sm-8 d-flex flex-column justify-content-center align-items-start">
                            <input type="email" class="form-control form-control-sm" id="datePreGross">
                        </div>
                    </div>
                    <div class="row m-0">
                        <label for="datePreAcc" class="col-sm-4 col-form-label d-flex flex-row align-content-end">
                            <span style="font-size: 10px; text-align: right">Date présumée <br> de l'Accouchement</span>
                        </label>
                        <div class="col-sm-8 d-flex flex-column justify-content-center align-items-start">
                            <input type="email" class="form-control form-control-sm" id="datePreAcc">
                        </div>
                    </div>
                </div>
            </div>
            <p class="mx-1 mb-0 px-2" style="background-color: #72B46E;color: black;font-size: x-large;padding-left: inherit;font-weight: bold;margin-top: 1px;">Prestations</p>
            <div class="row px-2 mx-1" style="background-color: #e8fcee;">
                <div class="col-md-4 d-flex flex-row align-items-center justify-content-center">
                    <div class="row m-0 w-100">
                        <label for="datePreGross" class="col-sm-4 col-form-label d-flex flex-row align-content-end">
                            <span style="font-size: 10px; text-align: right">Date et Heure <br> de la Prestation</span>
                        </label>
                        <div class="col-sm-8 d-flex flex-column justify-content-center align-items-start">
                            <input type="email" class="form-control form-control-sm" id="dateAffec">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-row align-items-center justify-content-center">
                    <span class="inline-block" style="font-size: 14px">Visite à Domicile</span>&nbsp;&nbsp;&nbsp;
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="wi" value="yes">
                        <label class="form-check-label" for="wi">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="non" value="no">
                        <label class="form-check-label" for="non">Non</label>
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-row align-items-center justify-content-center">
                    <div class="row m-0 m-0 w-100">
                        <label for="datePreGross" class="col-sm-4 col-form-label d-flex flex-row align-content-end">
                            <span style="font-size: 10px; text-align: right">Code<br> Affection</span>
                        </label>
                        <div class="col-sm-8 d-flex flex-column justify-content-center align-items-start">
                            <input type="email" class="form-control form-control-sm" id="codeAffec">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-5 mx-1" style="background-color: #e8fcee;">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center">Code Acte</th>
                        <th scope="col" style="text-align: center">Montant</th>
                        <th scope="col" style="text-align: center">Ticket Moderateur</th>
                        <th scope="col" style="text-align: center">Forfait Deplacement <span style="font-weight: lighter; font-size: 11px">(s'il ya lieu)</span> </th>
                        <th scope="col" style="text-align: center">Montant à Payer CNAMGS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="height: 30px; background-color: white"></th>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                        <td rowspan="4" style="background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    <tr>
                        <th style="height: 30px; background-color: white"></th>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    <tr>
                        <th style="height: 30px; background-color: white"></th>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    <tr>
                        <th style="height: 30px; background-color: #e8fcee; text-align: right">Total</th>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p class="mx-1 mb-0 px-2" style="background-color: #72B46E;color: black;font-size: x-large;padding-left: inherit;font-weight: bold;margin-top: 1px;">
                Prescriptions Médicales
            </p>
            <div class="row px-5 mx-1" style="background-color: #e8fcee;">
                <table class="tablePres">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center">Medicamen/Appareillages</th>
                        <th scope="col" style="text-align: center">Posologie</th>
                        <th scope="col" style="text-align: center">Quantités</th>
                        <th scope="col" style="text-align: center">Prix</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="2" style="height: 30px; background-color: white">Affection Courante (20%); Femme Enceinte (0%) </th>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <th style="height: 30px; background-color: white"></th>
                            <td style="height: 30px; background-color: white"></td>
                            <td style="height: 30px; background-color: white"></td>
                            <td style="height: 30px; background-color: white"></td>
                        </tr>
                    @endfor
                    <tr>
                        <th colspan="2" style="height: 30px; background-color: white">Affection Longue Durée (10%) </th>
                        <td style="height: 30px; background-color: white"></td>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    @for ($i = 0; $i < 3; $i++)
                        <tr>
                            <th style="height: 30px; background-color: white"></th>
                            <td style="height: 30px; background-color: white"></td>
                            <td style="height: 30px; background-color: white"></td>
                            <td style="height: 30px; background-color: white"></td>
                        </tr>
                    @endfor
                    <tr>
                        <th colspan="3" style="height: 30px; background-color: #e8fcee; text-align: right">Total Pharmacie</th>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    <tr>
                        <th colspan="3" style="height: 30px; background-color: #e8fcee; text-align: right">Total Ticket Modérateur Pharmacie</th>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    <tr>
                        <th colspan="3" style="height: 30px; background-color: #e8fcee; text-align: right">Total Pharmacie à la charge de la CNAMGS</th>
                        <td style="height: 30px; background-color: white"></td>
                    </tr>
                    </tbody>
                </table>
                <p class="fw-bolder">
                    Délivrance des médicaments par Pharmacie ou dépôt d'un établissement public <br>
                    <span class="fw-lighter" style="font-size: 11px">A remplir obligatoirement par les GEF (même en cas d'orientation vers une officine privée)</span>
                </p>
                <div class="row pt-2 d-flex align-items-end">
                    <div class="col-md-3 mt-0 ">
                        <span class="inline-block" style="font-size: 14px">OPSPPC*</span>&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="wi" value="yes">
                            <label class="form-check-label" for="wi">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="non" value="no">
                            <label class="form-check-label" for="non">Non</label>
                        </div>
                    </div>
                    <div class="col-md-3 mt-0">
                        <label for="nomEtabli" class="form-label">Nom de l'Etablissement </label>
                        <input type="text" class="form-control form-control-sm" id="nomEtabli" value="">
                    </div>
                    <div class="col-md-3 mt-0">
                        <label for="codePhar" class="form-label">Code Pharmacie </label>
                        <input type="text" class="form-control form-control-sm" id="codePhar" value="">
                    </div>
                    <div class="col-md-3 mt-0">
                        <label for="codePhar" class="form-label"> <span class="fw-bolder"> Si Intervention d'une pharmacie officine</span><br> Code Pharmacie Officine </label>
                        <input type="text" class="form-control form-control-sm" id="codePhar" value="">
                    </div>
                </div>
                <div class="row pt-2 d-flex align-items-end">
                    <div class="col-md-4 mt-0 ">
                        <label for="text" class="form-label fw-bolder" style="font-size: 13px">Signature et cachet du Praticien <span class="fw-lighter">(Obligatoire)</span></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <div class="col-md-4 mt-0">
                        <label for="text" class="form-label fw-bolder" style="font-size: 13px">Cachet de la Pharmacie Publique <span class="fw-lighter">(Obligatoire)</span></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <div class="col-md-4 mt-0">
                        <label for="text" class="form-label fw-bolder" style="font-size: 13px">Signature et Cachet Pharmacie Officine</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                </div>
                <span style="font-size: 11px">(*)OPSPPC: << Orienté par un prestataire de soins public ou un prestaire conventionné >>  </span>
            </div>
{{--            <button id="generatePdf">PDF Generate</button>--}}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    jQuery(document).ready(function(){
        $("#generatePdf").click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/feuille-de-soin/download') }}",
                method: 'get',
                // success: function(response){
                //     console.log(response)
                //     // if(response === 'True'){
                //     //     $('#name').addClass('is-invalid')
                //     // }
                //     //
                //     // if(response === 'False'){
                //     //     $('#name').addClass('is-valid')
                //     // }

                });
        });
    });
</script>
</body>
</html>
