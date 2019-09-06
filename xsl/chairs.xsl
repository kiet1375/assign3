<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Edited with XML Spy v4.2 -->
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" />

<xsl:param name="artistName"/>
<xsl:param name="sortValue"/>


<xsl:template match="/">

      <xsl:for-each select="catalog/index">

	  <xsl:sort select="price" data-type="number" order="{$sortValue}" />
		<xsl:value-of select="type"/>
        <xsl:value-of select="imgFront"/>
		<xsl:value-of select="imgRear"/>
		<xsl:value-of select="product"/>
        <xsl:value-of select="brand"/>
		<xsl:value-of select="price"/>
      </xsl:for-each>

</xsl:template>
</xsl:stylesheet>