<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns="http://www.w3.org/1999/xhtml">

    <xsl:output method="xml"
        encoding="utf-8"
        doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
        doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
        omit-xml-declaration="no"
        indent="yes" />

    <xsl:key name="jeden_gatunek" match="/kolekcja/podsumowanie/gatunki/gatunek/text()" use="." />

    <xsl:template match="/">
        <html>
            <head>
                <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
                <title>Kolekcja płyt</title>
            </head>
            <body style="background-color: peachpuff;">
                <xsl:apply-templates />
            </body>
        </html>
    </xsl:template>

    <xsl:template match="/kolekcja">
        <xsl:apply-templates select="nagłówek" />
        <xsl:call-template name="odnośniki_wykonawców" />
        <xsl:apply-templates select="podsumowanie" />
        <xsl:apply-templates select="wykonawcy" />
        <div>
            <p>
                <a href="http://validator.w3.org/check?uri=referer">
                    <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
                </a>
            </p>
        </div>
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek">
        <div>
            <span style="font-variant: small-caps; font-size: xx-large;"><xsl:value-of select="opis" />, Data: <xsl:value-of select="data" /></span>
        </div>
    </xsl:template>

    <xsl:template name="odnośniki_wykonawców">
        <div style="background-color: burlywood; width: 200px; padding: 5px; margin: 5px; float: left;
            border-style: double; border-width: 3px;">
            <xsl:text>Odnośniki: </xsl:text><br/>
            <xsl:for-each select="/kolekcja/wykonawcy/wykonawca">
                <xsl:text>&#9733; </xsl:text> 
                <a>
                <xsl:attribute name="href"><xsl:value-of select="concat('#', nazwa)" /></xsl:attribute>
                <xsl:value-of select="nazwa" />
                </a><br />
            </xsl:for-each>
        </div>
    </xsl:template>

    <xsl:template match="podsumowanie">
        <div style="background-color: burlywood; width: 200px; padding: 5px; margin: 5px; float: left; clear: left;
            border-style: double; border-width: 3px;">
            <xsl:text>Podsumowanie: </xsl:text><br />
            <table>
                <xsl:attribute name="summary">Tabela z podsumowaniem dokumentu</xsl:attribute>
                <tr>
                    <td><span style="font-weight: bold; text-align: left;">Suma wykonawców:</span></td>
                    <td><span><xsl:value-of select="wykonawców" /></span></td>
                </tr>
                <tr>
                    <td><span style="font-weight: bold; text-align: left;">Suma płyt:</span></td>
                    <td><span><xsl:value-of select="płyt" /></span></td>
                </tr>
                <tr>
                    <td><span style="font-weight: bold; text-align: left;">Suma utworów:</span></td>
                    <td><span><xsl:value-of select="utworów" /></span></td>
                </tr>
                <tr>
                    <td><span style="font-weight: bold; text-align: left;">Gatunki:</span></td>
                    <td><span><xsl:apply-templates select="./gatunki"/></span></td>
                </tr>
                <tr>
                    <td><span style="font-weight: bold; text-align: left;">Średni ranking:</span></td>
                    <td><span><xsl:value-of select="średni_ranking" /></span></td>
                </tr>
            </table>
        </div>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy">
        <table style="background-color: peru; margin: 3px; color: black; border-style: double; border-width: 3px;">
            <xsl:attribute name="summary">Tabela ze szczegółami kolekcji płyt</xsl:attribute>
            <xsl:apply-templates select="wykonawca" />
        </table>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <tr style="background-color: burlywood;">
            <td colspan="4">
                <a><xsl:attribute name="name"><xsl:value-of select="translate(nazwa, ' ', '_')" /></xsl:attribute></a>
                <b><xsl:value-of select="nazwa" /></b>
            </td>
            <td>
                <div class="gatunek" style="text-align: left; margin: 5px;">
                <xsl:text>gatunek: </xsl:text>
                <span style="text-align: right; float: right;"><xsl:value-of select="gatunek" /></span>
                </div>
            </td>
            <td>
                <div class="pozycje" style="text-align: left; margin: 5px;">
                <xsl:text>pozycje: </xsl:text>
                <span style="text-align: right; float: right;"><xsl:value-of select="ilość_płyt" /></span>
                </div>
            </td>
        </tr>
        <xsl:apply-templates select="płyty" />
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty">
        <xsl:apply-templates select="płyta" />
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta[position() mod 3 = 1]">
        <tr>
            <xsl:apply-templates mode="jedna_płyta" select=".|following-sibling::płyta[not(position() > 2)]" />
        </tr>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta" mode="jedna_płyta">
        <td style="border-width: 3px; border-style: solid;">
            <img height="300" width="300">
                <xsl:attribute name="src"><xsl:value-of select="concat('img/okladka_', @id, '.jpg')" /></xsl:attribute>
                <xsl:attribute name="alt"><xsl:value-of select="concat('Okładka płyty ', tytuł)" /></xsl:attribute>
            </img>
        </td>
        <td style="border-left-width: 0px; border-style: dashed;">
            <div class="opis_płyty" style="margin: 5px; clear: left;">
                <xsl:apply-templates select="tytuł" />
                <xsl:apply-templates select="ranking" />
                <xsl:apply-templates select="liczba_utworów" />
                <xsl:apply-templates select="czas_trwania" />
            </div>
        </td>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta[not(position() mod 3 = 1)]" />

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta/tytuł">
        <div style="font-variant: small-caps; float: left; font-size: x-large; margin-bottom: 15px; clear: both;"><xsl:value-of select="." /></div>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta/ranking">
        <div style="clear: left; text-align: left;">
            <xsl:text>Ocena: </xsl:text>
            <span style="font-weight: bold; text-align: right; float: right;"><xsl:value-of select="." /></span>
        </div>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta/liczba_utworów">
        <div style="clear: left; text-align: left;">
            <xsl:text>Liczba utworów: </xsl:text>
            <span style="font-weight: bold; text-align: right; float: right"><xsl:value-of select="." /></span>
        </div>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta/czas_trwania">
        <div style="clear: left; text-align: left;">
            <xsl:text>Czas trwania: </xsl:text>
            <span style="font-weight: bold; text-align: right; float: right"><xsl:value-of select="." /></span>
        </div>
    </xsl:template>

    <xsl:template match="/kolekcja/podsumowanie/gatunki">
        <xsl:for-each select="gatunek/text()[generate-id()
                                       = generate-id(key('jeden_gatunek',.)[1])]">
            <xsl:value-of select="."/><br />
        </xsl:for-each>
    </xsl:template>

</xsl:stylesheet>
