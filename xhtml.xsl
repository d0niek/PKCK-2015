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
        <table style="background-color: peru; margin: 3ex 2em; color: black;" border="3">
            <xsl:attribute name="summary">Tabela ze szczegółami kolekcji płyt</xsl:attribute>
            <xsl:apply-templates select="wykonawca" />
        </table>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <tr>
            <td><xsl:value-of select="nazwa" /></td>
        </tr>
        <xsl:apply-templates select="płyty" />
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty">
        <xsl:apply-templates select="płyta" />
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta">
        <tr>
            <td><xsl:value-of select="position()" />
                <img height="300" width="300">
                    <xsl:attribute name="src"><xsl:value-of select="concat('img/okladka_', @id, '.jpg')" /></xsl:attribute>
                    <xsl:attribute name="alt"><xsl:value-of select="concat('Okładka płyty ', tytuł)" /></xsl:attribute>
                </img>
            </td>
        </tr>
    </xsl:template>

</xsl:stylesheet>
