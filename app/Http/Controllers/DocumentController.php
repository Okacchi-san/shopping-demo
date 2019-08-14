<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class DocumentController extends Controller
{
    private $pdf; // インスタンス変数を宣言

    public function __construct(TCPDF $pdf)
    {
        $this->middleware('auth');
        // コンストラクタインジェクションでTCPDFクラスをインスタンス化
        $this->pdf = $pdf;
    }

    public function downloadPdf(Request $request)
    {
        // フォント、スタイル、サイズ をセット
        $this->pdf->setFont('kozminproregular','',10);
        // ページを追加
        $this->pdf->addPage();
        // HTMLを描画、viewの指定と変数代入
        $this->pdf->writeHTML(view("document.pdf", ['name' => ''])->render());
        // 出力の指定です、ファイル名、拡張子、Dはダウンロードを意味します。
        $this->pdf->output('test' . '.pdf', 'D');
        //return;
        //$request->session()->forget('cart');
    return;
    //return redirect('/home')->with('success', 'お買い上げありがとうございます。');
   }
}
