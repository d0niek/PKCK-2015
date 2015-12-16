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
        <xsl:apply-templates select="wykonawcy" />
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek">
        <span style="font-variant: small-caps;"><xsl:value-of select="opis" />, Data: <xsl:value-of select="data" /></span><br />
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy">
        <table style="background-color: peru; margin: 3ex 2em; color: black; border-style: double; border-width: 3px;">
            <xsl:attribute name="summary">Tabela ze szczegółami kolekcji płyt</xsl:attribute>
            <xsl:apply-templates select="wykonawca" />
        </table>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <tr style="background-color: burlywood;">
            <td colspan="4"><b><xsl:value-of select="nazwa" /></b></td>
            <td>
                gatunek: <div style="float: right; clear: right; text-align: right;"><xsl:value-of select="gatunek" /></div>
            </td>
            <td>
                pozycje: <div style="float: right; clear: right; text-align: right;"><xsl:value-of select="ilość_płyt" /></div>
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
            <xsl:value-of select="position()" />
            <img height="300" width="300">
                <xsl:attribute name="src"><xsl:value-of select="concat('img/okladka_', @id, '.jpg')" /></xsl:attribute>
                <xsl:attribute name="alt"><xsl:value-of select="concat('Okładka płyty ', tytuł)" /></xsl:attribute>
            </img>
        </td>
        <td width="150" style="border-left-width: 0px; border-style: dashed;">
            <div class="opis_płyty" style="margin: 5px;">
                <xsl:apply-templates select="tytuł" />
                <xsl:apply-templates select="ranking" />
                <xsl:apply-templates select="liczba_utworów" />
                <xsl:apply-templates select="czas_trwania" />
            </div>
        </td>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta[not(position() mod 3 = 1)]" />

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta/tytuł">
        <div style="font-variant: small-caps; float: left; font-size: x-large; margin-bottom: 15px; clear: both;"><p3><xsl:value-of select="." /></p3></div>
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

   

</xsl:stylesheet>
